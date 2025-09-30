<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\OrderDetailes;
use App\Services\Admin\OrderService;

class Show extends Component
{
     use WithPagination;


    public $search;
    public $statuses;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public $order;
    public $orderId;

    protected $listeners = ['refreshData' => '$refresh'];



    public function mount($id,OrderService $orderService): void
    {
        $this->orderId              = $id;
        $this->order                = $orderService->find($this->orderId);
        // $this->statuses              = Status::where('id','<>',1)->get();
    }




    public function render(OrderService $orderService)
    {

        $viewData = $orderService->show($orderService->find($this->orderId), $this->search);
        return view('livewire.admin.order.show', $viewData);
    }
}
