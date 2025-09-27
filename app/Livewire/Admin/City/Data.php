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


    public function updatingSearch()
    {
        $this->resetPage();
    }

    
    public function render(CityService $city)
    {
        $data = $city->index($this->search);
        return view('livewire.admin.city.data',compact('data'));
    }
}
