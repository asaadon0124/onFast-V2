<?php

namespace App\Livewire\Admin\City;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Admin\CityService;

class Data extends Component
{
    use WithPagination;

    protected $listeners = ['refreshData' => '$refresh'];
    public $search;


    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    
    public function render(CityService $cityService)
    {
        $data = $cityService->index($this->search);
        return view('livewire.admin.city.data',['data' => $data]);
    }
}
