<?php

namespace App\Livewire\Admin\Reborts;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\Admin\RebortService;
use App\Exports\SuppliersRebortExport;

class Data extends Component
{
    public $search;
    public $supplier_id;
    public $status_id;
    public $totalPrice;
    public $start_date;
    public $end_date;
    public $data_filter = [];




     use WithPagination;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['refreshData' => '$refresh'];


    public function updatingSearch(): void
    {
        $this->search = trim((string) $this->search); // هنا برجع القيمة مظبوطة
        $this->resetPage();
    }

    public function setStatus($statusId): void
    {
        $this->status_id = $statusId;
        $this->resetPage();
    }


    public function submit(): void
    {

        $this->data_filter =
        [  'supplier_id'    => $this->supplier_id,
            'start_date'    => $this->start_date,
            'end_date'      => $this->end_date,
        ];

        // $rebortService->filterNewProducts(Product::query(), $this->data_filter);
    }


    public function export(RebortService $rebortService)
    {
        return Excel::download(
            new SuppliersRebortExport($rebortService, $this->status_id, $this->data_filter),
            'report_' . now()->format('Y_m_d') . '.xlsx'
        );
    }


    public function render(RebortService $rebortService)
    {
        $suppliers = $rebortService->getSuppliers();
        // $newProducts = $rebortService->getNewProducts($this->search);
        // $get_order_detailes = $rebortService->getAllOrderDetailes($this->status_id);

         // لو الحالة = 1 هجيب من المنتجات الجديدة
        if ($this->status_id == 1)
        {
            $data               = $rebortService->getNewProducts($this->search, $this->data_filter);
            $newProducts        = $data['newProducts'];
            $this->totalPrice   = $data['total_prices'];
            $get_order_detailes = collect(); // فاضي علشان مايحصلش تعارض
            // dd($this->totalPrice);
        } else
        {
            $get_order_detailes = $rebortService->getAllOrderDetailes($this->status_id, $this->search, $this->data_filter);
            $newProducts        = collect(); // فاضي برضو
        }
        return view('livewire.admin.reborts.data',['suppliers' => $suppliers, 'newProducts' => $newProducts, 'get_order_detailes' => $get_order_detailes]);
    }
}
