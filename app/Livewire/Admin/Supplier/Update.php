<?php

namespace App\Livewire\Admin\Supplier;

use App\Models\City;
use Livewire\Component;
use App\Models\Governorate;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Supplier\Data;
use App\Services\ActionHistoryService;
use App\Services\Admin\SupplierService;
use App\Http\Requests\Admin\SupplierRequest;

class Update extends Component
{
    public $name                = '';
    public $governorate_id      = '';
    public $city_id             = '';
    public $adress              = '';
    public $phone               = '';

    public $supplierID              = '';
    public $governorates        = [];
    public $city;
    public $supplier;
    protected $supplierService;
    public $cities              = [];


     protected $listeners = ['supplierUpdate'];



    public function supplierUpdate($id,SupplierService $supplierService)
    {

        $this->supplierService  = $supplierService;
        $this->supplierID       = $id;
        $this->supplier         = $this->supplierService->find($id); // هنا شغال
        $this->governorates     = Governorate::all();
        $this->cities           = City::where('governorate_id',$this->supplier->governorate_id)->get();

        $this->name             = $this->supplier->name;
        $this->governorate_id   = $this->supplier->governorate_id;
        $this->city_id          = $this->supplier->city_id;
        $this->adress          = $this->supplier->adress;
        $this->phone          = $this->supplier->phone;
        //    $this->governorates      = Cache::get('governorates_all');

        $this->dispatch('updateModalToggle');
    }

    public function change_gov($value)
    {
        $this->cities = City::where('governorate_id',$value)->get();
    }



    public function submit(ActionHistoryService $action_history,supplierService $supplierService)
    {
        $validated = $this->validate((new SupplierRequest())->rules($this->supplierID), (new SupplierRequest())->messages());
        try
        {
            DB::beginTransaction();
                $supplierService->update($validated, app(supplierService::class)->find($this->supplierID));
                // refreshCitiesCache();
                $action_history->action('تعديل مورد',"تعديل مورد {$this->name}",'Supplier', $this->supplierID,auth('admin')->user()->id);
            DB::commit();

        } catch (\Throwable $e)
        {
            DB::rollBack();
            $this->dispatch('suppliersErrorMS'); // Flash Message خطأ
        }

        $this->reset(); // مسح الحقول

        $this->dispatch('suppliersUpdateMS');
        $this->dispatch('updateModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }

    public function render()
    {
        return view('livewire.admin.supplier.update');
    }
}
