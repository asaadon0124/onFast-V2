<?php

namespace App\Livewire\Admin\Servant;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Servant\Data;
use App\Http\Requests\ServantRequest;
use App\Services\ActionHistoryService;
use App\Services\Admin\ServantService;

class Create extends Component
{
    public $name                = '';
    public $password            = '';
    public $adress              = '';
    public $phone               = '';
    public $password_confirmation               = '';


    protected $listeners = ['servantCreate'];


    public function servantCreate()
    {
        $this->dispatch('createModalToggle');
    }





     public function submit(ServantService $servantService,ActionHistoryService $action_history)
    {
        //  dd($this->all());
        $validated = $this->validate((new ServantRequest())->rules(), (new ServantRequest())->messages());

       try
       {
            DB::beginTransaction();

                $servant = $servantService->create($validated);   // 1 - CREATE NEW CITY
                // refreshCitiesCache();   // 2 - Update Cities Cache
                $action_history->action('اضافة مندوب جديد',"انشاء مندوب جديد {$servant->name}",'Servant', $servant->id,auth('admin')->user()->id);   // 3 - CREATE NEW ACTION HISTORY
            DB::commit();

       } catch (\Throwable $e)
       {
            dd($e);
            DB::rollBack();

            $this->dispatch('servantsErrorMS'); // Flash Message خطأ
       }


        // بعد الحفظ تقدر تصفر الحقول أو تقفل المودال
        $this->reset(['name', 'password', 'password_confirmation','phone','adress']);
        $this->dispatch('servantsCreateMS');
        $this->dispatch('createModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }

    public function render()
    {
        return view('livewire.admin.servant.create');
    }
}
