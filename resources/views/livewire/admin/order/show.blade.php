<div>
    {{-- بطاقة تفاصيل خط السير --}}
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">تفاصيل خط السير رقم {{ $order->tracking_number }}</h5>
        </div>
        <div class="card-body">
            <div class="row">

                {{-- رقم خط السير --}}
                <div class="col-md-6 mb-3">
                    <strong>رقم خط السير</strong><br>
                    {!! DNS1D::getBarcodeHTML($order->tracking_number, 'C128', 2, 40) !!}
                    <div class="mt-2">{{ $order->tracking_number }}</div>
                </div>

                {{-- بيانات المندوب --}}
                @if ($order->servant)
                    <div class="col-md-6 mb-3">
                        <strong>المندوب</strong><br>
                        {{ $order->servant->name }} <br>
                        <i class="fas fa-phone"></i> {{ $order->servant->phone }}
                    </div>
                @endif

                {{-- إحصائيات --}}
                <div class="col-md-4 mb-3">
                    <strong>عدد الشحنات</strong><br>
                    {{ $order->orderDetailes->count() }} شحنات
                </div>
                <div class="col-md-4 mb-3">
                    <strong>إجمالي السعر</strong><br>
                    {{ number_format(abs($order->total_prices), 2) }} جنيه
                </div>
                <div class="col-md-4 mb-3">
                    <strong>ربح المندوب</strong><br>
                    {{ number_format(abs($order->total_servant_profit), 2) }} جنيه
                </div>

                <div class="col-md-4 mb-3">
                    <strong>ربح الشركة</strong><br>
                    {{ number_format(abs($order->total_profit), 2) }} جنيه
                </div>
                <div class="col-md-4 mb-3">
                    <strong>التحصيل من المندوب</strong><br>
                    {{ number_format(abs($order->total_prices - $order->total_servant_profit), 2) }} جنيه
                </div>

                {{-- الحالة --}}
                <div class="col-md-6 mb-3">
                    <strong>الحالة السابقة</strong><br>
                    {{ $order->coming_from }}
                </div>
                <div class="col-md-6 mb-3">
                    <strong>الحالة الحالية</strong><br>
                    <span class="badge badge-info">{{ $order->status_text }}</span>
                </div>

                {{-- الملاحظات --}}
                <div class="col-md-12 mb-3">
                    <strong>الملاحظات</strong><br>
                    {{ $order->notes ?? '-' }}
                </div>

                {{-- التواريخ --}}
                <div class="col-md-6 mb-3">
                    <strong>تاريخ الإنشاء</strong><br>
                    {{ $order->created_at }} بواسطة {{ $order->adminCreate->name }}
                </div>
                <div class="col-md-6 mb-3">
                    <strong>آخر تحديث</strong><br>
                    {{ $order->last_update }}
                </div>
            </div>
        </div>
    </div>


    {{-- جدول الشحنات --}}
    <div class="card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">شحنات خط السير</h5>
            @if ($order->status == 'active')
                <button class="btn btn-success btn-sm"
                    wire:click.prevent="$dispatch('orderDetailesCreate',{id: {{ $order->id }}})">
                    <i class="fas fa-plus"></i> إضافة شحنة
                </button>
            @endif
            <input type="text" wire:model.live="search" class="form-control w-25" placeholder="بحث...">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class=" text-center" style="background-color: #f79400">
                    <tr>
                        <th>#</th>
                        <th>رقم الشحنة</th>
                        <th>بيانات المورد</th>
                        <th>بيانات المستلم</th>
                        <th>العنوان</th>
                        <th>سعر الشحنة</th>
                        <th>سعر الشحن</th>
                        <th>الإجمالي</th>
                        <th>الحالة</th>
                        <th>تاريخ التحديث</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @php $x=1; @endphp
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $x++ }}</td>
                            <td>
                                {!! DNS1D::getBarcodeHTML($item->product->tracking_number, 'C128', 1, 30) !!}
                                <div>{{ $item->product->tracking_number }}</div>
                            </td>
                            <td>
                                {{ $item->product->supplier->name ?? '-' }} <br>
                                {{ $item->product->supplier->phone ?? '-' }}
                            </td>
                            <td>
                                {{ $item->product->resever_name ?? '-' }} <br>
                                {{ $item->product->resver_phone ?? '-' }}
                            </td>
                            <td>
                                {{ $item->product->governorate->name ?? '-' }} -
                                {{ $item->product->city->name ?? '-' }}
                            </td>
                            <td>{{ $item->product->product_price ?? '-' }}</td>
                            <td>{{ $item->shipping_price ?? '-' }}</td>
                            <td>{{ $item->total_price ?? '-' }}</td>
                            <td>
                                <livewire:admin.order-detailes.change-status :item="$item" :key="'status-'.$item->id" />
                                {{-- <span class="badge badge-warning mt-3" style="width: 100%;padding:10%">
                                    {{ $item->status->name ?? 'غير محدد' }}
                                </span> --}}


                            </td>
                            <td>
                                تحديث {{ $item->updated_at }}<br>
                                <small>بواسطة {{ $item->adminUpdate->name }}</small>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    @if ($order->approve == 0)
                                        <button class="btn btn-primary"
                                            wire:click.prevent="$dispatch('OrderDetailesUpdate', {id: {{ $item->id }}})">
                                            تعديل
                                        </button>
                                        @if ($item->product_status == 2)
                                         <button class="btn btn-danger"
                                            wire:click.prevent="$dispatch('OrderDetailesDelete', {id: {{ $item->id }}})">
                                            حذف
                                        </button>
                                        @endif

                                    @endif
                                    {{-- <button class="btn btn-info"
                                        wire:click.prevent="$dispatch('purchaseOrderDetailesShow', {id: {{ $item->id }}})">
                                        عرض
                                    </button> --}}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <h5 style="color: #f00"><span style="color: #f79400">ملحوظة</span> لحذف اي شحنة من خط السير يجب ان تكون حالة الشحنة خرج للشحن </h5>
            {{ $data->links('pagination::bootstrap-4') }}

        </div>
    </div>
</div>
