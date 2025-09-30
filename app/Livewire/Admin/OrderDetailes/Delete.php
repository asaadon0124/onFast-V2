<?php

namespace App\Livewire\Admin\OrderDetailes;

use Livewire\Component;
use App\Livewire\Admin\Order\Show;
use Illuminate\Support\Facades\DB;
use App\Services\ActionHistoryService;
use App\Services\Admin\OrderDetailesService;

class Delete extends Component
{
    public $orderDetailes;
    protected $orderDetailesService;
    protected $listeners = ['OrderDetailesDelete','refreshData' => '$refresh'];


    public function OrderDetailesDelete($id, OrderDetailesService $orderDetailesService): void
    {
        $this->orderDetailesService = $orderDetailesService;
        $this->orderDetailes = $orderDetailesService->find($id);
        $this->dispatch('deleteModalToggle');
    }

    public function submit(ActionHistoryService $actionHistoryService,OrderDetailesService $orderDetailesService): void
    {

        if ($this->orderDetailes->product_status != 2)
        {
            $this->addError('product_status', 'لا يمكن حذف الشحنة و الحالة الخاصة بها لا = خرج للشحن.');
            return;
        }

        // $validated = $this->validate((new OrderDetailesRequest())->rules($this->productDetailesID), (new OrderDetailesRequest())->messages());
        try
        {
            DB::beginTransaction();
                $orderDetailesService->delete($this->orderDetailes);
                $actionHistoryService->action('حذف الشحنة في خط السير',"حذف الشحنة في خط السير {$this->orderDetailes->product->tracking_number}",'OrderDetailes', $this->orderDetailes->id,auth('admin')->user()->id);
            DB::commit();

        } catch (\Throwable $e)
        {
            dd($e);
            DB::rollBack();
            $this->dispatch('orderDetailesErrorMS'); // Flash Message خطأ
        }

        $this->reset(); // مسح الحقول

        $this->dispatch('orderDetailesDeleteMS');
        $this->dispatch('deleteModalToggle');
        $this->dispatch('refreshData')->to(Show::class);
    }

    public function render()
    {
        return view('livewire.admin.order-detailes.delete');
    }
}
