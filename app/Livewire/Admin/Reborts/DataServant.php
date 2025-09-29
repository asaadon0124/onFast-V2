<?php

namespace App\Livewire\Admin\Reborts;

use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SuppliersRebortExport;
use App\Services\Admin\RebortServantService;

class DataServant extends Component
{
    public $search;
    public $servant_id;
    public $status_id;
    public $totalPrice;
    public $start_date;
    public $end_date;
    public $data_filter = [];


    use WithPagination;

    protected $paginationTheme  = 'bootstrap';
    protected $listeners        = ['refreshData' => '$refresh'];


    public function updatingSearch()
    {
        $this->search = trim($this->search); // هنا برجع القيمة مظبوطة
        $this->resetPage();
    }


    public function setStatus($statusId)
    {
        $this->status_id = $statusId;
        $this->resetPage();
    }




     public function submit()
    {

        $this->data_filter =
        [  'servant_id'    => $this->servant_id,
            'start_date'    => $this->start_date,
            'end_date'      => $this->end_date,
        ];
    }


    // public function export(RebortServantService $rebortServantService)
    // {
    //     return Excel::download(
    //         new SuppliersRebortExport($rebortServantService, $this->status_id, $this->data_filter),
    //         'report_' . now()->format('Y_m_d') . '.xlsx'
    //     );
    // }




    public function render(RebortServantService $rebortServantService)
    {
        $servants           = $rebortServantService->getServants();
        $get_order_detailes = $rebortServantService->getAllOrderDetailes($this->status_id, $this->search, $this->data_filter);
        $newProducts        = collect(); // فاضي برضو


        return view('livewire.admin.reborts.data-servant',compact('servants','get_order_detailes'));
    }
}
