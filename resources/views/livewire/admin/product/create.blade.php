<div class="modal fade text-start modal-primary" id="createModal" tabindex="-1" aria-hidden="true" style="display: none;"
    wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">اضافة شحنة جديدة  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form form-horizontal" wire:submit.prevent='submit'>
                <div class="modal-body">
                    <div class="row">

                         {{-- tracking_number رقم الشحنة --}}
                        {{-- <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>رقم الشحنة</label>
                                <input type="text" class="form-control" placeholder="ادخل رقم الشحنة" wire:model="tracking_number">
                                @include('admins.alerts.error', ['property' => 'tracking_number'])
                            </div>
                        </div> --}}



                        {{-- resever_name اسم المستلم --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>اسم المستلم</label>
                                <input type="text" class="form-control" placeholder="ادخل اسم المستلم" wire:model="resever_name">
                                @include('admins.alerts.error', ['property' => 'resever_name'])
                            </div>
                        </div>


                        {{-- resver_phone تليفون المستلم --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>تليفون المستلم</label>
                                <input type="number" class="form-control" placeholder="ادخل تليفون المستلم" wire:model="resver_phone">
                                @include('admins.alerts.error', ['property' => 'resver_phone'])
                            </div>
                        </div>


                         {{-- resver_address عنوان المستلم --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>عنوان المستلم</label>
                                <input type="text" class="form-control" placeholder="ادخل عنوان المستلم" wire:model="resver_address">
                                @include('admins.alerts.error', ['property' => 'resver_address'])
                            </div>
                        </div>


                        {{-- اسم المورد supplier_id --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>اسم المورد</label>

                                <select class="form-control select2" wire:model="supplier_id">
                                    <option selected>اسم المورد</option>
                                    @if (isset($suppliers))
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('admins.alerts.error', ['property' => 'supplier_id'])
                            </div>
                        </div>


                        {{-- اسم المحافظة governorate_id --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>اسم المحافظة</label>

                                <select class="form-control select2" wire:model="governorate_id" wire:change="change_gov($event.target.value)">
                                    <option selected>اسم المحافظة</option>
                                    @if (isset($governorates))
                                        @foreach ($governorates as $governrate)
                                            <option value="{{ $governrate->id }}">{{ $governrate->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('admins.alerts.error', ['property' => 'governorate_id'])
                            </div>
                        </div>



                         {{-- اسم المدينة city_id --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>اسم المدينة</label>
                                   <select class="form-control select2" wire:model="city_id">
                                    <option selected>اسم المدينة</option>
                                    @if (isset($governorates))
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('admins.alerts.error', ['property' => 'city_id'])

                            </div>
                        </div>


                        {{-- سعر الشحنة product_price --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>سعر الشحنة</label>
                                <input type="text" class="form-control" placeholder="ادخل سعر الشحنة" wire:model="product_price" wire:change="change_product_price($event.target.value)">
                                @include('admins.alerts.error', ['property' => 'product_price'])
                            </div>
                        </div>


                         {{-- سعر الشحن shipping_price --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>سعر الشحن</label>
                                <input type="text" class="form-control" placeholder="ادخل سعر الشحن" wire:model="shipping_price" wire:change="change_shipping_price($event.target.value)">
                                @include('admins.alerts.error', ['property' => 'shipping_price'])
                            </div>
                        </div>


                         {{-- الاجمالي total_price --}}
                        <div class="col-sm-4 mb-4">
                            <div class="form-group">
                                <label>الاجمالي</label>
                                <input type="text" class="form-control" placeholder="ادخل الاجمالي" wire:model="total_price" readonly>
                                @include('admins.alerts.error', ['property' => 'total_price'])
                            </div>
                        </div>

                         {{-- rescive_date تاريخ التسليم --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>تاريخ التسليم</label>
                                <input type="date" class="form-control" placeholder="ادخل تاريخ التسليم" wire:model="rescive_date">
                                @include('admins.alerts.error', ['property' => 'rescive_date'])
                            </div>
                        </div>


                         {{-- ملاحظات notes --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>الملاحظات</label>
                                <textarea name="" id="" cols="40" rows="2" wire:model="notes"></textarea>                                @include('admins.alerts.error', ['property' => 'total_price'])
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" type="button"
                        class="btn btn-success waves-effect waves-float waves-light">اضاقة</button>
                </div>
            </form>
        </div>
    </div>
</div>
