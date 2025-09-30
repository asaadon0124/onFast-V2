<?php

namespace App\Livewire\Admin\Reborts;

use App\Models\Supplier;
use Livewire\Component;
use App\Services\Admin\RebortService;

class PrintRebort extends Component
{
    public $status_id, $search, $supplier, $start_date, $end_date, $totalPrice,$supplier_id,$data_filter=[];

    public function mount(RebortService $rebortService, $status_id = null, $search = null, $supplier = null, $start_date = null, $end_date = null): void
    {
        $this->status_id    = $status_id;
        $this->search       = $search;
        $this->start_date   = $start_date;
        $this->end_date     = $end_date;
        $this->supplier_id  = $supplier ? Supplier::find($supplier)->id : null;

       $this->data_filter =
        [   'supplier_id'    => $this->supplier_id,
            'start_date'     => $this->start_date,
            'end_date'       => $this->end_date,
        ];
        // $this->supplier_id  = $this->supplier->id;
    }

    public function printReport(): void
    {
        // dd($this->data_filter);
        $this->dispatch('printWindow');

    }

    public function render(RebortService $rebortService)
    {
        // dd($this->status_id);
        if ($this->status_id == 1)
        {
            //  dd('new');
            $data               = $rebortService->getNewProducts($this->search,$this->data_filter);
            $newProducts        = $data['newProducts'];
            $this->totalPrice   = $data['total_prices'];
            $get_order_detailes = collect();
            // dd($newProducts);
        } else
        {
            //  dd('orderdetailes');
            $get_order_detailes = $rebortService->getAllOrderDetailes($this->status_id, $this->search,$this->data_filter);
            $newProducts        = collect();
            $this->totalPrice   = $get_order_detailes->sum('total_price');
        }

        return view('livewire.admin.reborts.print-rebort', ['get_order_detailes' => $get_order_detailes, 'newProducts' => $newProducts])->with(['status_id' => $this->status_id]);
    }
}

