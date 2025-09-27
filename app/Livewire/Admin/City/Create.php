<?php

namespace App\Livewire\Admin\City;

use Livewire\Component;
use App\Models\Governorate;
use App\Livewire\Admin\City\Data;
use App\Http\Requests\CityRequest;
use Illuminate\Support\Facades\DB;
use App\Services\Admin\CityService;
use Illuminate\Support\Facades\Cache;
use App\Services\ActionHistoryService;



class Create extends Component
{
    public $name                = '';
    public $governorate_id      = '';
    public $governorates        = [];

    protected $listeners = ['cityCreate'];


    public function cityCreate()
    {
        $this->governorates = Cache::get('governorates_all');
        $this->dispatch('createModalToggle');
    }


    public function submit(CityService $cityService,ActionHistoryService $action_history)
    {
        $validated = $this->validate((new CityRequest())->rules(), (new CityRequest())->messages());

       try
       {
            DB::beginTransaction();
                $city = $cityService->create($validated);   // 1 - CREATE NEW CITY
                refreshCitiesCache();   // 2 - Update Cities Cache
                $action_history->action('اضافة مدينة جديدة','انشاء مدينة جديدة {$city->name}','City', $city->id,auth('admin')->user()->id);   // 3 - CREATE NEW ACTION HISTORY
            DB::commit();

       } catch (\Throwable $e)
       {
            dd($e);
            DB::rollBack();

            $this->dispatch('citiesErrorMS'); // Flash Message خطأ
       }


        // بعد الحفظ تقدر تصفر الحقول أو تقفل المودال
        $this->reset(['name', 'governorate_id']);
        $this->dispatch('citiesCreateMS');
        $this->dispatch('createModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }


    public function render()
    {
        return view('livewire.admin.city.create');
    }
}
