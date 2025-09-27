<?php

namespace App\Livewire\Admin\Governorate;

use Livewire\Component;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\ActionHistoryService;
use App\Livewire\Admin\Governorate\Data;
use App\Http\Requests\GovernorateRequest;
use App\Services\Admin\GovernorateService;

class Create extends Component
{
    public $name               = '';

     protected $listeners = ['governorateCreate'];


    public function governorateCreate()
    {
        // show Create modal
        $this->dispatch('createModalToggle');
    }



    public function submit(GovernorateService $governorateService, ActionHistoryService $action_history)
    {

        $validated = $this->validate((new GovernorateRequest())->rules(), (new GovernorateRequest())->messages());

        try
        {
            DB::beginTransaction();

                $governorate = $governorateService->create($validated);
                $action_history->action('اضافة محافظة جديدة','انشاء محافظة جديدة {$governorate->name}','Governorate', $governorate->id,auth('admin')->user()->id);

            DB::commit();
        } catch (\Throwable $e)
        {
            dd($e);
            DB::rollBack();
            $this->dispatch('governoratesErrorMS'); // Flash Message خطأ
        }



        $this->reset(); // مسح الحقول

        $this->dispatch('governoratesCreateMS');
        $this->dispatch('createModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }




    public function render()
    {
        return view('livewire.admin.governorate.create');
    }
}
