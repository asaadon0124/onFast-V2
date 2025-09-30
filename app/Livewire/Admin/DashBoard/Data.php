<?php

namespace App\Livewire\Admin\DashBoard;

use App\Admin\DashboardInterface;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh'];
    public $search;


    public function updatingSearch(): void
    {
        $this->search = trim((string) $this->search); // هنا برجع القيمة مظبوطة
        $this->resetPage();
    }





    public function render(DashboardInterface $dashboard)
    {
        $new_products           = $dashboard->getNewProducts($this->search);
        // $getOrderDetailes       = $dashboardService->getNewProducts($this->search);
        $getProductsWithDetails       = $dashboard->getProductsWithDetails($this->search);
        $active_orders_count    = $dashboard->getActiveOrdersCount();

        return view('livewire.admin.dash-board.data',
        [
            'getProductsWithDetails'      => $getProductsWithDetails,
            'new_products'          => $new_products,
            'active_orders'         => $active_orders_count,
        ]);
    }
}
