<?php

namespace App\Livewire\Admin\Governorate;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Admin\GovernorateService;

class Data extends Component
{
    use WithPagination;

    protected $listeners = ['refreshData' => '$refresh'];

    public $search;
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render(GovernorateService $GovernorateService)
    {
        $data = $GovernorateService->index($this->search);
        return view('livewire.admin.governorate.data', compact('data'));
    }
}
