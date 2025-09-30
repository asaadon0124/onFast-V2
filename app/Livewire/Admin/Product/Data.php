<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\Admin\ProductService;

class Data extends Component
{
    use WithPagination;

        protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh'];
    public $search;


    public function updatingSearch(): void
    {
        $this->resetPage();
    }



    public function render(ProductService $productService)
    {
        // dd($product->index($this->search));
        $data = $productService->index($this->search);
        return view('livewire.admin.product.data',['data' => $data]);
    }
}
