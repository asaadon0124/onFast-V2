<?php

namespace App\Livewire\Admin\Order;

use App\Models\Servant;
use Livewire\Component;
use App\Livewire\Admin\Order\Data;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Services\Admin\OrderService;
use App\Services\ActionHistoryService;

class Create extends Component
{
    public $tracking_number;

    public $total_prices            = 0;
    public $total_servant_profit    = 0;
    public $total_profit            = 0;
    public $servant_id              = '';
    public $notes                   = '';
    public $servants                = [];




     protected $listeners = ['orderCreate'];


    public function orderCreate(): void
    {
        $this->servants = Servant::select('id','name','phone')->get();
        $this->dispatch('createModalToggle');
    }


     public function submit(OrderService $orderService,ActionHistoryService $actionHistoryService): void
    {
        $validated = $this->validate((new OrderRequest())->rules(), (new OrderRequest())->messages());

       try
       {
            DB::beginTransaction();
                $order = $orderService->create($validated);   // 1 - CREATE NEW PRODUCT
                // refreshCitiesCache();   // 2 - Update Cities Cache
                $actionHistoryService->action('اضافة خط سير جديد',"انشاء خط سير جديد {$order->tracking_number}",'Order', $order->id,auth('admin')->user()->id);   // 3 - CREATE NEW ACTION HISTORY
            DB::commit();

       } catch (\Throwable)
       {
            DB::rollBack();

            // For debugging purposes, you can uncomment the line below to see the error
            // dd($e);

            $this->dispatch('ordersErrorMS'); // Flash Message خطأ
       }


        // بعد الحفظ تقدر تصفر الحقول أو تقفل المودال
        $this->reset();
        $this->dispatch('ordersCreateMS');
        $this->dispatch('createModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }

    public function render()
    {
        return view('livewire.admin.order.create');
    }
}
