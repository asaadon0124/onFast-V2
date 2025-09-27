<div dir="rtl">
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header text-right">
                            <div class="card-title" dir="rtl">
                                البحث بواسطة اسم المورد و تاريخ الشحنات الخاصة به
                            </div>
                        </div>
                        <div class="card-body">
                            <form class="form form-horizontal" wire:submit.prevent='submit'>
                                <div class="modal-body">
                                    <div class="row">

                                        {{-- اسم المورد supplier_id --}}
                                        <div class="col-sm-3 mb-4">
                                            <div class="form-group">
                                                <label>اسم المورد</label>
                                                <div wire:ignore>
                                                    <select class="form-control select2_supplier" id="supplier_id_select2">
                                                        <option value="">اختر المورد</option>
                                                        @if (isset($suppliers))
                                                            @foreach ($suppliers as $supplier)
                                                                <option value="{{ $supplier->id }}">
                                                                    {{ $supplier->name }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>

                                                @include('admins.alerts.error', [
                                                    'property' => 'supplier_id',
                                                ])
                                            </div>
                                        </div>


                                        {{-- تاريخ البداية start_date --}}
                                        <div class="col-sm-3 mb-4">
                                            <div class="form-group">
                                                <label>تاريخ البداية</label>
                                                <input type="date" class="form-control"
                                                    placeholder="ادخل تاريخ البداية" wire:model="start_date">
                                                @include('admins.alerts.error', [
                                                    'property' => 'start_date',
                                                ])

                                            </div>
                                        </div>



                                        {{-- تاريخ النهاية end_date --}}
                                        <div class="col-sm-3 mb-4">
                                            <div class="form-group">
                                                <label>تاريخ النهاية</label>
                                                <input type="date" class="form-control"
                                                    placeholder="ادخل تاريخ النهاية" wire:model="end_date">
                                                @include('admins.alerts.error', ['property' => 'end_date'])

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" type="button"
                                        class="btn btn-warning waves-effect waves-float waves-light">بحث</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>






                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header text-right">
                            <div class="card-title" dir="rtl">
                                تفاصيل الشحنات {{ $status_id }}
                            </div>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="btn-group w-100 mb-3">
                                    <button class="btn btn-info {{ $status_id == 1 ? 'active' : '' }}"
                                        wire:click="setStatus(1)">داخل الشركة</button>
                                    <button class="btn btn-info {{ $status_id == 2 ? 'active' : '' }}"
                                        wire:click="setStatus(2)">خرج للشحن</button>
                                    <button class="btn btn-info {{ $status_id == 3 ? 'active' : '' }}"
                                        wire:click="setStatus(3)">تم الرفض</button>
                                    <button class="btn btn-info {{ $status_id == 4 ? 'active' : '' }}"
                                        wire:click="setStatus(4)">تأجيل</button>
                                    <button class="btn btn-info {{ $status_id == 5 ? 'active' : '' }}"
                                        wire:click="setStatus(5)">تم التوصيل</button>
                                    <button class="btn btn-info {{ $status_id == 6 ? 'active' : '' }}"
                                        wire:click="setStatus(6)">تم التحصيل</button>
                                    <button class="btn btn-info {{ $status_id == 7 ? 'active' : '' }}"
                                        wire:click="setStatus(7)">تسليم المرتجع</button>
                                </div>
                                <div class="mb-2">
                                    <input type="text" wire:model.live="search" class="form-control w-25"
                                        placeholder="بحث">


                                    <a class="btn btn-success" wire:navigate href="{{ route('reborts.print') }}">
                                        🖨️ طباعة التقرير
                                    </a>




                                </div>
                            </div>
                            <div>
                                {{-- جدول / كروت عرض النتائج --}}
                                <div class="row">
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $x=1; @endphp
                                                @if (!empty($get_order_detailes) && $status_id != 1)
                                                    {{--  شحنات خطوط السير --}}
                                                    @foreach ($get_order_detailes as $item)
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
                                                                {{ $item->status->name ?? 'غير محدد' }}
                                                            </td>
                                                            <td>
                                                                تحديث {{ $item->updated_at }}<br>
                                                                <small>بواسطة {{ $item->adminUpdate->name }}</small>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @elseif (!empty($newProducts) && $status_id == 1)
                                                    {{--  الشحنات الجديدة --}}
                                                    @foreach ($newProducts as $item)
                                                        <tr>
                                                            <td>{{ $x++ }}</td>
                                                            <td>
                                                                {!! DNS1D::getBarcodeHTML($item->tracking_number, 'C128', 1, 30) !!}
                                                                <div>{{ $item->tracking_number }}</div>
                                                            </td>
                                                            <td>
                                                                {{ $item->supplier->name ?? '-' }} <br>
                                                                {{ $item->supplier->phone ?? '-' }}
                                                            </td>
                                                            <td>
                                                                {{ $item->resever_name ?? '-' }} <br>
                                                                {{ $item->resver_phone ?? '-' }}
                                                            </td>
                                                            <td>
                                                                {{ $item->governorate->name ?? '-' }} -
                                                                {{ $item->city->name ?? '-' }}
                                                            </td>
                                                            <td>{{ $item->product_price ?? '-' }}</td>
                                                            <td>{{ $item->shipping_price ?? '-' }}</td>
                                                            <td>{{ $item->total_price ?? '-' }}</td>
                                                            <td>
                                                                {{ $item->statusRelation->name ?? 'غير محدد' }}
                                                            </td>
                                                            <td>
                                                                تحديث {{ $item->updated_at }}<br>
                                                                <small>بواسطة {{ $item->adminUpdate->name }}</small>
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                @else
                                                    {{--  مفيش شحنات --}}
                                                    <tr>
                                                        <td colspan="7">
                                                            <div class="text-danger text-center">لا يوجد بيانات</div>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>

                                        <div class="mt-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                @if ($status_id == 1)
                                                    <strong>إجمالي أسعار الشحنات: </strong>
                                                    {{ number_format($totalPrice, 2) }}
                                                @else
                                                    <strong>إجمالي أسعار الشحنات: </strong>
                                                    {{-- {{ number_format($totalPrice, 2) }} --}}
                                                @endif
                                            </div>
                                            <div>
                                                @if ($status_id == 1)
                                                    {{ $newProducts->links() }}
                                                @else
                                                    {{ $get_order_detailes->links() }}
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
