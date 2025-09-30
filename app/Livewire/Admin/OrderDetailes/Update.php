<?php

namespace App\Livewire\Admin\OrderDetailes;

use App\Http\Requests\OrderDetailesRequest;
use App\Livewire\Admin\Order\Show;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Services\ActionHistoryService;
use App\Services\Admin\OrderDetailesService;

class Update extends Component
{




    public $product_price       = 0;
    public $shipping_price      = 0;
    public $total_price         = 0;
    public $tracking_number;
    public $notes;
    public $coming_from;
    public $old_status;
    public $order_id;
    public $productDetailesID;
    public $product_status;
    public $product_id;
    public ?Product $selectedProduct = null;
    public $product;
    public $old_product_price;
    public $products            = [];
    protected $orderDetailesService;


    protected $listeners = ['OrderDetailesUpdate'];


    public function OrderDetailesUpdate($id, OrderDetailesService $orderDetailesService): void
    {
        $this->products             = Product::where('status_id', '1')->get();
        $this->orderDetailesService = $orderDetailesService;
        $this->productDetailesID    = $id;
        $this->product              = $this->orderDetailesService->find($id); // هنا شغال

        if ($this->product && $this->product->product)
        {
            $this->products->push($this->product->product);
            $this->product_id = $this->product->product_id; // Set the dropdown
            $this->selectedProduct = $this->product->product; // Set the initial details view
        }
        // $this->governorates      = Cache::get('governorates_all');

        $this->notes                = $this->product->notes;
        $this->tracking_number      = $this->product->tracking_number;
        $this->product_price        = $this->product->product->product_price;
        $this->shipping_price       = $this->product->shipping_price;
        $this->total_price          = $this->product->total_price;
        $this->old_status           = $this->product->coming_from;
        $this->old_product_price    = $this->product->product->product_price;
        $this->product_status       = $this->product->product_status;
        $this->coming_from          = $this->product->coming_from;
        $this->dispatch('updateModalToggle');
        $this->dispatch('product-updated', product_id: $this->product_id);
    }


    public function updatedproductID($id): void
    {
        if ($id)
        {
            // dd('dd');
            $this->selectedProduct      = Product::with('governorate', 'city', 'supplier')->find($id);
            $this->product_price        = $this->selectedProduct->product_price;
            $this->shipping_price       = $this->selectedProduct->shipping_price;
            $this->total_price          = $this->selectedProduct->total_price;
            $this->old_status           = 1;
            $this->product_status       = 2;
            $this->coming_from          = 1;
        } else
        {
            $this->selectedProduct = null;
        }
    }


    public function change_shipping_price($value): void
    {
        $this->shipping_price = $value;
        $this->total_price = $value + $this->product_price;
    }


    public function submit(ActionHistoryService $actionHistoryService,OrderDetailesService $orderDetailesService): void
    {

        if ($this->product_price != $this->old_product_price && $this->product_id == ${$this}->product->product->id)
        {
            $this->addError('product_price', 'سعر الشحنة غير صحيح.');
            return;
        }

        if ($this->total_price != ($this->old_product_price + $this->shipping_price))
        {
            $this->addError('total_price', 'الاجمالي غير صحيح.');
            return;
        }

        $validated = $this->validate((new OrderDetailesRequest())->rules(), (new OrderDetailesRequest())->messages());
        try
        {
            DB::beginTransaction();
                $orderDetailesService->update($validated, app(OrderDetailesService::class)->find($this->productDetailesID));
                // refreshCitiesCache();
                $actionHistoryService->action('تعديل الشحنة في خط السير',"تعديل الشحنة في خط السير {$this->tracking_number}",'OrderDetailes', $this->productDetailesID,auth('admin')->user()->id);
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
        $this->dispatch('refreshData')->to(Show::class);
    }




    public function render()
    {
        return view('livewire.admin.order-detailes.update');
    }
}
