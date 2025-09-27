<?php

namespace App\Livewire\Admin\Servant;

use App\Models\Servant;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Servant\Data;
use App\Http\Requests\ServantRequest;
use App\Services\ActionHistoryService;
use App\Services\Admin\ServantService;

class Update extends Component
{
    public $name                = '';
    public $adress              = '';
    public $phone               = '';
    public $password            = '';
    public $password_confirmation               = '';

    public $servantID           = '';
    public $servant;
    protected $servantService;


    protected $listeners = ['servantUpdate'];



    public function servantUpdate($id,ServantService $servantService)
    {

        $this->servantService  = $servantService;
        $this->servantID       = $id;
        $this->servant         = $this->servantService->find($id); // هنا شغال

        $this->name            = $this->servant->name;
        $this->adress          = $this->servant->adress;
        $this->phone           = $this->servant->phone;
        //    $this->governorates      = Cache::get('governorates_all');

        $this->dispatch('updateModalToggle');
    }






 public function submit(ActionHistoryService $action_history,ServantService $servantService)
    {
        $validated = $this->validate((new ServantRequest())->rules($this->servantID), (new ServantRequest())->messages());
        try
        {
            DB::beginTransaction();
                $servantService->update($validated, app(servantService::class)->find($this->servantID));
                // refreshCitiesCache();
                $action_history->action('تعديل مندوب',"تعديل مندوب {$this->name}",'Servant', $this->servantID,auth('admin')->user()->id);
            DB::commit();

        } catch (\Throwable $e)
        {
            DB::rollBack();
            $this->dispatch('servantsErrorMS'); // Flash Message خطأ
        }

        $this->reset(); // مسح الحقول

        $this->dispatch('servantsUpdateMS');
        $this->dispatch('updateModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }



    public function render()
    {
        return view('livewire.admin.servant.update');
    }
}
