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


    public function updatingSearch()
    {
        $this->resetPage();
    }



    public function render(ProductService $product)
    {
        // dd($product->index($this->search));
        $data = $product->index($this->search);
        return view('livewire.admin.product.data',compact('data'));
    }
}
