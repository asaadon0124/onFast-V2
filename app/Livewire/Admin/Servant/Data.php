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

    public function updatingSearch(): void
    {
        $this->resetPage();
    }



    public function render(ServantService $servantService)
    {
        $data = $servantService->index($this->search);
        return view('livewire.admin.servant.data',['data' => $data]);
    }
}
