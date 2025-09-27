<?php

namespace App\Livewire\Admin\Supplier;

use App\Services\Admin\SupplierService;
use Livewire\Component;
use Livewire\WithPagination;

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


    public function render(SupplierService $supplierService)
    {
        $data = $supplierService->index($this->search);
        return view('livewire.admin.supplier.data',compact('data'));
    }
}
