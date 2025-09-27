<?php

namespace App\Livewire\Admin\City;

use App\Models\City;
use Livewire\Component;
use App\Models\Governorate;
use App\Livewire\Admin\City\Data;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\DB;
use App\Services\Admin\CityService;
use Illuminate\Support\Facades\Cache;
use App\Services\ActionHistoryService;

class Update extends Component
{
    public $name                = '';
    public $governorate_id      = '';
    public $cityID               = '';
    public $governorates        = [];
    public $city;
    protected $cityService;






    protected $listeners = ['cityUpdate'];



    public function cityUpdate($id,CityService $cityService)
    {
        $this->cityService = $cityService;
        $this->cityID = $id;
        $city = $this->cityService->find($id); // هنا شغال

        $this->governorates      = Cache::get('governorates_all');
        $this->name             = $city->name;
        $this->governorate_id   = $city->governorate_id;

        $this->dispatch('updateModalToggle');
    }



    public function submit(ActionHistoryService $action_history,CityService $cityService)
    {
        $validated = $this->validate((new CityRequest())->rules($this->cityID), (new CityRequest())->messages());
        try
        {
            DB::beginTransaction();
                $cityService->update($validated, app(CityService::class)->find($this->cityID));
                refreshCitiesCache();
                $action_history->action('تعديل مدينة',"تعديل مدينة {$this->name}",'City', $this->cityID,auth('admin')->user()->id);
            DB::commit();

        } catch (\Throwable $e)
        {
            DB::rollBack();
            $this->dispatch('citiesErrorMS'); // Flash Message خطأ
        }

        $this->reset(); // مسح الحقول

        $this->dispatch('citiesUpdateMS');
        $this->dispatch('updateModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }

    public function render()
    {
        return view('livewire.admin.city.update');
    }
}
