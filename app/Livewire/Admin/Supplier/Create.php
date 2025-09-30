<?php

namespace App\Livewire\Admin\Supplier;

use App\Http\Requests\Admin\SupplierRequest;
use App\Models\City;
use Livewire\Component;
use App\Models\Governorate;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Supplier\Data;
use App\Services\ActionHistoryService;
use App\Services\Admin\SupplierService;

class Create extends Component
{
    public $name                = '';
    public $governorate_id      = '';
    public $city_id             = '';
    public $adress              = '';
    public $phone               = '';
    public $governorates        = [];
    public $cities              = [];

    protected $listeners = ['supplierCreate'];


    public function supplierCreate(): void
    {
        $this->governorates = Governorate::all();
        $this->dispatch('createModalToggle');
    }


    public function change_gov($value): void
    {
        $this->cities = City::where('governorate_id',$value)->get();
    }


     public function submit(SupplierService $supplierService,ActionHistoryService $actionHistoryService): void
    {
        $validated = $this->validate((new SupplierRequest())->rules(), (new SupplierRequest())->messages());

       try
       {
        // dd($this->all());
            DB::beginTransaction();
                $supplier = $supplierService->create($validated);   // 1 - CREATE NEW CITY
                // refreshCitiesCache();   // 2 - Update Cities Cache
                $actionHistoryService->action('اضافة مورد جديد',"انشاء مورد جديد {$supplier->name}",'Supplier', $supplier->id,auth('admin')->user()->id);   // 3 - CREATE NEW ACTION HISTORY
            DB::commit();

       } catch (\Throwable $e)
       {
            dd($e);
            DB::rollBack();

            $this->dispatch('citiesErrorMS'); // Flash Message خطأ
       }


        // بعد الحفظ تقدر تصفر الحقول أو تقفل المودال
        $this->reset(['name', 'governorate_id','city_id','phone','adress']);
        $this->dispatch('suppliersCreateMS');
        $this->dispatch('createModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }

    public function render()
    {
        return view('livewire.admin.supplier.create');
    }
}
