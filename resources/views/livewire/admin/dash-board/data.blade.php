<div>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

            {{-- الشحنات الجديدة  --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $new_products }}</h3>

                        <p>الشحنات الجديدة</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('products.index') }}" class="small-box-footer">عرض المزيد <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            {{-- خطوط السير المفتوحة  --}}
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $active_orders }} <sup style="font-size: 20px">خطوط سير</sup></h3>

                        <p>خطوط السير المفتوحة</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('orders.index') }}" class="small-box-footer">عرض المزيد <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>44</h3>

                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>65</h3>

                        <p>Unique Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>

    <input type="text" wire:model.live="search" class="form-control w-25 mt-3 mb-3" placeholder="بحث...">

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
                @foreach ($getProductsWithDetails as $item)
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

                            @if ($item->status_id != 1)
                                <livewire:admin.order-detailes.change-status
                                    :item="$item->orderDetailes->last()"
                                    :key="'status-' . $item->id" />
                                    {{-- {{ $item->status_id }} --}}
                            @else
                                داخل الشركة
                            @endif
                        </td>

                        <td>
                            تحديث {{ $item->updated_at }}<br>
                            <small>بواسطة {{ $item->adminUpdate->name }}</small>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $getProductsWithDetails->links() }}
    </div>
</div>
