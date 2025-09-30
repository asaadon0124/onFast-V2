<?php

namespace App\Livewire\Admin\Product;

use App\Models\City;
use App\Models\Status;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Product\Data;
use App\Http\Requests\ProductRequest;
use App\Services\ActionHistoryService;
use App\Services\Admin\ProductService;

class Create extends Component
{
    public $tracking_number;
    public $resever_name        = '';
    public $resver_phone        = '';
    public $resver_address      = '';
    public $supplier_id                = '';
    public $governorate_id      = '';
    public $city_id             = '';
    public $product_price       = 0;
    public $shipping_price      = 0;
    public $total_price         = 0;
    public $status_id           = '';
    public $notes               = '';
    public $rescive_date;

    public $governorates        = [];
    public $cities              = [];
    public $suppliers           = [];
    public $statuses            = [];



    protected $listeners = ['productCreate'];


    public function productCreate(): void
    {
        $this->governorates = Governorate::all();
        $this->suppliers    = Supplier::select('id','name')->get();
        $this->dispatch('createModalToggle');
    }


    public function change_gov($value): void
    {
        $this->cities = City::where('governorate_id',$value)->get();
    }

    public function change_product_price($value): void
    {
        $this->product_price = $value;
        $this->total_price = $value + $this->shipping_price;
    }



    public function change_shipping_price($value): void
    {
        $this->shipping_price = $value;
        $this->total_price = $value + $this->product_price;
    }


    public function submit(ProductService $productService,ActionHistoryService $actionHistoryService): void
    {
        $validated = $this->validate((new ProductRequest())->rules(), (new ProductRequest())->messages());

       try
       {
            DB::beginTransaction();
                $product = $productService->create($validated);   // 1 - CREATE NEW PRODUCT
                // refreshCitiesCache();   // 2 - Update Cities Cache
                $actionHistoryService->action('اضافة شحنة جديدة',"انشاء شحنة جديدة {$product->tracking_number}",'Product', $product->id,auth('admin')->user()->id);   // 3 - CREATE NEW ACTION HISTORY
            DB::commit();

       } catch (\Throwable)
       {
            DB::rollBack();

            // For debugging purposes, you can uncomment the line below to see the error
            // dd($e);

            $this->dispatch('productsErrorMS'); // Flash Message خطأ
       }


        // بعد الحفظ تقدر تصفر الحقول أو تقفل المودال
        $this->reset();
        $this->dispatch('productsCreateMS');
        $this->dispatch('createModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }



    public function render()
    {
        return view('livewire.admin.product.create');
    }
}
