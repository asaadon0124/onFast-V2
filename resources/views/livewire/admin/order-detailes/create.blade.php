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

                        {{-- Select Shipment --}}
                        <div class="col-12 mb-2">
                            <div class="form-group">
                                <label>اختر الشحنة</label>
                                <select class="form-control select2" wire:model.live="product_id">
                                    <option value="">-- اختر شحنة --</option>
                                    @if (isset($products))
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->resever_name }} ({{ $product->resver_phone }})</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('admins.alerts.error', ['property' => 'product_id'])
                            </div>
                        </div>

                        {{-- Display Shipment Details --}}
                        @if ($selectedProduct)
                            <div class="col-12" x-data="{ open: true }">
                                {{-- Toggle Button --}}
                                <button @click="open = !open" type="button" class="btn btn-sm btn-outline-primary mb-1 w-100">
                                    <span x-text="open ? 'اخفاء التفاصيل' : 'اظهار التفاصيل'"></span>
                                    <i class="ms-1" :class="{ 'fa-solid fa-chevron-up': open, 'fa-solid fa-chevron-down': !open }"></i>
                                </button>

                                {{-- Details Card --}}
                                <div class="card border-primary" x-show="open" x-transition>
                                    <div class="card-header">
                                        <h4 class="card-title">تفاصيل الشحنة المحددة</h4>
                                    </div>
                                    <div class="card-body">
                                        <dl class="row">
                                            {{-- Recipient Info --}}
                                            <dt class="col-sm-3">اسم المستلم</dt>
                                            <dd class="col-sm-9">{{ $selectedProduct->resever_name }}</dd>

                                            <dt class="col-sm-3">تليفون المستلم</dt>
                                            <dd class="col-sm-9">{{ $selectedProduct->resver_phone }}</dd>

                                            {{-- Address Info --}}
                                            <dt class="col-sm-3">المحافظة</dt>
                                            <dd class="col-sm-9">{{ $selectedProduct->governorate->name ?? 'غير محدد' }}</dd>

                                            <dt class="col-sm-3">المدينة</dt>
                                            <dd class="col-sm-9">{{ $selectedProduct->city->name ?? 'غير محدد' }}</dd>

                                            {{-- Pricing Info --}}
                                            <dt class="col-sm-3">سعر الشحنة</dt>
                                            <dd class="col-sm-9">{{ number_format($selectedProduct->product_price, 2) }} جنيه</dd>

                                            <dt class="col-sm-3">سعر الشحن</dt>
                                            <dd class="col-sm-9">{{ number_format($selectedProduct->shipping_price, 2) }} جنيه</dd>

                                            <dt class="col-sm-3">الإجمالي</dt>
                                            <dd class="col-sm-9 fw-bold">{{ number_format($selectedProduct->total_price, 2) }} جنيه</dd>

                                            {{-- Supplier Info --}}
                                            <dt class="col-sm-3 border-top pt-2 mt-2">اسم المورد</dt>
                                            <dd class="col-sm-9 border-top pt-2 mt-2">{{ $selectedProduct->supplier->name ?? 'غير محدد' }}</dd>

                                            <dt class="col-sm-3">تليفون المورد</dt>
                                            <dd class="col-sm-9">{{ $selectedProduct->supplier->phone ?? 'غير محدد' }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        @endif


                          {{-- Notes Field --}}
                        <div class="col-12 mb-4">
                            <div class="form-group">
                                <label for="notes">الملاحظات</label>
                                <textarea id="notes" class="form-control" rows="2" wire:model="notes"></textarea>
                                @include('admins.alerts.error', ['property' => 'notes'])
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
