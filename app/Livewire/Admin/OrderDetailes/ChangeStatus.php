<?php

namespace App\Livewire\Admin\OrderDetailes;

use App\Models\Status;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Services\ActionHistoryService;
use App\Http\Requests\ChangeStatusRequest;
use App\Services\Admin\ProductManagementStatusService;

class ChangeStatus extends Component
{

public $statuses;
public $product_status;
public $productDetailesID;
public $status_id;
public $update_btn = false;


    public function mount($item): void
    {
        $this->statuses              = Status::whereNotIn('id', [1, 6, 7])->get();
        $this->productDetailesID     = $item->id;
        $this->product_status        = $item->product_status;
        $this->status_id             = $item->status_id;
        // dd($item->status_id);
    }



    public function change_product_status($value): void
    {
        $this->product_status   = $value;
        $this->status_id        = $value;
        $this->update_btn = true;
    }


    public function updateStatus(ActionHistoryService $actionHistoryService,ProductManagementStatusService $productManagementStatusService): void
    {
        // dd($this->all());
       try
       {
        DB::beginTransaction();
            $validated      = $this->validate((new ChangeStatusRequest())->rules(), (new ChangeStatusRequest())->messages());
            $orderDetailes  = $productManagementStatusService->changeStatus($validated,app(ProductManagementStatusService::class)->find($this->productDetailesID));
            $actionHistoryService->action('تعديل حالة الشحنة في خط السير',"تعديل حالة الشحنة في خط السير {$orderDetailes->product->tracking_number}",'OrderDetailes', $this->productDetailesID,auth('admin')->user()->id);
            $this->update_btn = false;
        DB::commit();

       } catch (\Throwable $e)
       {
            dd($e);
            DB::rollBack();
            $this->dispatch('ordersErrorMS'); // Flash Message خطأ
       }
    }



    public function render()
    {
        return view('livewire.admin.order-detailes.change-status');
    }
}
