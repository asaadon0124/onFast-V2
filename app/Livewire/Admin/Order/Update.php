<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use App\Models\Servant;
use Livewire\Component;
use App\Livewire\Admin\Order\Data;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Services\Admin\OrderService;
use App\Services\ActionHistoryService;

class Update extends Component
{

    public $orderID             = '';
    public $governorates        = [];
    public $order;
    protected $orderService;
    public $total_prices;
    public $total_servant_profit;
    public $total_profit;
    public $tracking_number;
    public $servant_id              = '';
    public $notes                   = '';
    public $servants                = [];


    protected $listeners = ['orderUpdate'];



    public function orderUpdate($id,OrderService $orderService)
    {
        $this->servants = Servant::select('id','name','phone')->get();
        $this->orderService = $orderService;
        $this->orderID = $id;
        $order = $this->orderService->find($id); // هنا شغال
        // dd($order);
        // $this->governorates      = Cache::get('governorates_all');
        $this->notes             = $order->notes;
        $this->servant_id        = $order->servant_id;
        $this->tracking_number   = $order->tracking_number;
        $this->total_prices   = $order->total_prices;
        $this->total_servant_profit   = $order->total_servant_profit;
        $this->total_profit   = $order->total_profit;
        // dd($this->total_prices);
        $this->dispatch('updateModalToggle');
    }



    public function submit(ActionHistoryService $action_history,OrderService $orderService)
    {
        $validated = $this->validate((new OrderRequest())->rules($this->orderID), (new OrderRequest())->messages());
        try
        {
            DB::beginTransaction();
                $orderService->update($validated, app(OrderService::class)->find($this->orderID));
                refreshCitiesCache();
                $action_history->action('تعديل خط السير',"تعديل خط السير {$this->tracking_number}",'Order', $this->orderID,auth('admin')->user()->id);
            DB::commit();

        } catch (\Throwable $e)
        {
            dd($e);
            DB::rollBack();
            $this->dispatch('ordersErrorMS'); // Flash Message خطأ
        }

        $this->reset(); // مسح الحقول

        $this->dispatch('ordersUpdateMS');
        $this->dispatch('updateModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }



    public function render()
    {
        return view('livewire.admin.order.update');
    }
}
