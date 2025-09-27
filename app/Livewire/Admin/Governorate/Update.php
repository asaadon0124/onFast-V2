<?php

namespace App\Livewire\Admin\Governorate;

use Livewire\Component;
use App\Services\ActionHistoryService;
use App\Livewire\Admin\Governorate\Data;
use App\Http\Requests\GovernorateRequest;
use App\Services\Admin\GovernorateService;

class Update extends Component
{
    public $name;
    public $govID;

    protected $listeners = ['governorateUpdate'];



     // Listener لتلقي الـ ID وفتح المودال
    public function governorateUpdate($id)
    {

        $governorate = app(GovernorateService::class)->find($id);

        $this->name = $governorate->name;
        $this->govID = $id;

        $this->dispatch('updateModalToggle'); // فتح المودال
    }



    public function submit(GovernorateService $governorateService , ActionHistoryService $action_history)
    {
        $validated = $this->validate((new GovernorateRequest())->rules($this->govID), (new GovernorateRequest())->messages());


        try
        {
            $governorate = $governorateService->update($validated, app(GovernorateService::class)->find($this->govID));
            $action_history->action('تعديل محافظة','تعديل محافظة {$governorate->name}','Governorate', $governorate->id,auth('admin')->user()->id);


        } catch (\Throwable $e)
        {
            dd($e);


            $this->dispatch('governoratesErrorMS'); // Flash Message خطأ
        }

        $this->reset(); // مسح الحقول

        $this->dispatch('governoratesUpdateMS');
        $this->dispatch('updateModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }




    public function render()
    {
        return view('livewire.admin.governorate.update');
    }
}
