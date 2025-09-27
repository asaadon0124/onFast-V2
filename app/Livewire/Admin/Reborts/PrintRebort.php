<?php

namespace App\Livewire\Admin\Reborts;

use Livewire\Component;
use App\Services\Admin\RebortService;

class PrintRebort extends Component
{
    public $status_id, $search, $supplier, $start_date, $end_date, $totalPrice;

    public function mount(RebortService $rebortService, $status_id = null, $search = null, $supplier = null, $start_date = null, $end_date = null)
    {
        $this->status_id  = $status_id;
        $this->search     = $search;
        $this->start_date = $start_date;
        $this->end_date   = $end_date;
        $this->supplier   = $supplier ? \App\Models\Supplier::find($supplier) : null;
    }

    public function printReport()
    {
        $this->dispatch('printWindow');

    }

    public function render(RebortService $rebortService)
    {
        if ($this->status_id == 1)
        {
            $data               = $rebortService->getNewProducts($this->search);
            $newProducts        = $data['newProducts'];
            $this->totalPrice   = $data['total_prices'];
            $get_order_detailes = collect();
        } else
        {
            $get_order_detailes = $rebortService->getAllOrderDetailes($this->status_id, $this->search);
            $newProducts        = collect();
            $this->totalPrice   = $get_order_detailes->sum('total_price');
        }

        return view('livewire.admin.reborts.print-rebort', compact('get_order_detailes', 'newProducts'));
    }
}

