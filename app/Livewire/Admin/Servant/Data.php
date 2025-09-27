<?php

namespace App\Livewire\Admin\Servant;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Admin\ServantService;

class Data extends Component
{
    use WithPagination;

    protected $listeners = ['refreshData' => '$refresh'];
    public $search;
    // public $searchAccountType;

    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function render(ServantService $servant_service)
    {
        $data = $servant_service->index($this->search);
        return view('livewire.admin.servant.data',compact('data'));
    }
}
