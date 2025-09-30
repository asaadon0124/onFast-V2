<?php

namespace App\Livewire\Admin\Product;

use App\Models\City;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\Governorate;
use Illuminate\Support\Facades\DB;
use App\Livewire\Admin\Product\Data;
use App\Http\Requests\ProductRequest;
use App\Services\ActionHistoryService;
use App\Services\Admin\ProductService;

class Update extends Component
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
    protected $productService;
    public $productID;
    public $product;






    protected $listeners = ['productUpdate'];



    public function productUpdate($id,ProductService $productService): void
    {
        $this->productService   = $productService;
        $this->productID        = $id;
        $product                = $this->productService->find($id); // هنا شغال
        $this->governorates     = Governorate::all();
        $this->cities           = City::where('governorate_id',$product->governorate_id)->get();
        $this->suppliers        = Supplier::select('id','name')->get();

        // $this->governorates      = Cache::get('governorates_all');
        $this->tracking_number              = $product->tracking_number;
        $this->resever_name                 = $product->resever_name;
        $this->resver_phone                 = $product->resver_phone;
        $this->resver_address               = $product->resver_address;
        $this->supplier_id                  = $product->supplier_id;
        $this->city_id                      = $product->city_id;
        $this->product_price                = $product->product_price;
        $this->shipping_price               = $product->shipping_price;
        $this->total_price                  = $product->total_price;
        $this->status_id                    = $product->status_id;
        $this->notes                        = $product->notes;
        $this->rescive_date                 = $product->rescive_date;
        $this->governorate_id               = $product->governorate_id;

        $this->dispatch('updateModalToggle');
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


    public function submit(ActionHistoryService $actionHistoryService,ProductService $productService): void
    {
        $validated = $this->validate((new ProductRequest())->rules($this->productID), (new ProductRequest())->messages());
        try
        {
            DB::beginTransaction();
                $productService->update($validated, app(ProductService::class)->find($this->productID));
                // refreshCitiesCache();
                $actionHistoryService->action('تعديل الشحنة',"تعديل الشحنة {$this->tracking_number}",'Product', $this->productID,auth('admin')->user()->id);
            DB::commit();

        } catch (\Throwable)
        {
            DB::rollBack();
            $this->dispatch('productsErrorMS'); // Flash Message خطأ
        }

        $this->reset(); // مسح الحقول

        $this->dispatch('productsUpdateMS');
        $this->dispatch('updateModalToggle');
        $this->dispatch('refreshData')->to(Data::class);
    }




    public function render()
    {
        return view('livewire.admin.product.update');
    }
}
