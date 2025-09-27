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


    public function updatingSearch()
    {
        $this->search = trim($this->search); // هنا برجع القيمة مظبوطة
        $this->resetPage();
    }





    public function render(DashboardInterface $dashboardService)
    {
        $new_products           = $dashboardService->getNewProducts($this->search);
        // $getOrderDetailes       = $dashboardService->getNewProducts($this->search);
        $getProductsWithDetails       = $dashboardService->getProductsWithDetails($this->search);
        $active_orders_count    = $dashboardService->getActiveOrdersCount();

        return view('livewire.admin.dash-board.data',
        [
            'getProductsWithDetails'      => $getProductsWithDetails,
            'new_products'          => $new_products,
            'active_orders'         => $active_orders_count,
        ]);
    }
}
