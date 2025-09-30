<?php

namespace App\Livewire\Admin\OrderDetailes;

use App\Models\Product;
use Livewire\Component;
use App\Models\OrderDetailes;
use App\Livewire\Admin\Order\Show;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Services\Admin\OrderService;
use App\Services\ActionHistoryService;
use App\Http\Requests\OrderDetailesRequest;
use App\Services\Admin\OrderDetailesService;

class Create extends Component
{


    public $product_price       = 0;
    public $shipping_price      = 0;
    public $total_price         = 0;
    public $notes;
    public $coming_from;
    public $order_id;
    public $product_id;
    public $product_status;
    public $old_product_status;
    public ?Product $selectedProduct = null;



    public $products            = [];






    protected $listeners = ['orderDetailesCreate'];


    public function orderDetailesCreate($id): void
    {
        $this->order_id = $id; // Capture the Order ID from the parent component
        $this->products = Product::where('status_id', '1')->get();
        $this->dispatch('createModalToggle');
    }


    public function updatedProductId($id): void
    {
        if ($id)
        {
            $this->selectedProduct  = Product::with('governorate', 'city', 'supplier')->find($id);
            $this->product_price    = $this->selectedProduct->product_price;
            $this->shipping_price   = $this->selectedProduct->shipping_price;
            $this->total_price      = $this->selectedProduct->total_price;
            $this->product_status   = 2;
            $this->coming_from      = $this->selectedProduct->status_id;
        } else
        {
            $this->selectedProduct = null;
        }
    }


     public function submit(OrderDetailesService $orderDetailesService,ActionHistoryService $actionHistoryService): void
    {
        // dd($this->all());
        $validated = $this->validate((new OrderDetailesRequest())->rules(), (new OrderDetailesRequest())->messages());

       try
       {
            DB::beginTransaction();
                $product = $orderDetailesService->create($validated,$this->order_id,$this->selectedProduct);   // 1 - CREATE NEW PRODUCT
                // refreshCitiesCache();   // 2 - Update Cities Cache
                $actionHistoryService->action('اضافة شحنة جديدة الي خط السير',"انشاء شحنة جديدة الي خط السير {$product->product->tracking_number}",'OrderDetailes', $product->id,auth('admin')->user()->id);   // 3 - CREATE NEW ACTION HISTORY
            DB::commit();

       } catch (\Throwable $e)
       {
            DB::rollBack();

            dd($e);

            $this->dispatch('orderDetailesErrorMS'); // Flash Message خطأ
       }


        // بعد الحفظ تقدر تصفر الحقول أو تقفل المودال
        $this->reset();
        $this->dispatch('orderDetailesCreateMS');
        $this->dispatch('createModalToggle');
        $this->dispatch('refreshData')->to(Show::class);
    }

    public function render()
    {
        return view('livewire.admin.order-detailes.create');
    }
}

