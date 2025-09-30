<?php

namespace App\Livewire\Admin\Order;

use App\Admin\OrderInterface;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Admin\OrderService;

class Data extends Component
{
    use WithPagination;

    protected $listeners = ['refreshData' => '$refresh'];
    public $search;


    public function updatingSearch(): void
    {
        $this->resetPage();
    }





    public function render(OrderInterface $order)
    {
        $data = $order->index($this->search);
        return view('livewire.admin.order.data',['data' => $data]);
    }
}
