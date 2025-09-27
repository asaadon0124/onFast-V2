<div class="table-responsive" wire:ignore.self>

    <div class="card-header ">
        <input type="text" wire:model.live="search" class="form-control w-25"
            placeholder="بحث">

        {{-- @can('اضافة حط سير جديد') --}}
            <button class="btn btn-primary" wire:click.prevent="$dispatch('orderCreate')">اضافة</button>
        {{-- @endcan --}}

    </div>
    <table class="table table-bordered table-striped dataTable" style="margin: 10px">
        <thead>
            <tr>
                <th>#</th>
                <th>رقم الحط سير</th>
                <th>اسم المندوب</th>
                <th>اجمالي خط السير</th>
                <th>اجمالي حساب المندوب</th>
                <th>اجمالي الربح</th>
                <th>حالة خط السير</th>
                <th>الملاحظات</th>
                <th>انشاء بواسطة</th>
                <th>اخر تحديث</th>
                <th>الاجراءات</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($data))
                @php $x = 1; @endphp
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $x++ }}</td>
                        <td>
                            {!! DNS1D::getBarcodeHTML($item->tracking_number, 'C128', 1, 33) !!}
                            <br>
                            {{ $item->tracking_number }}
                        </td>
                        <td>
                            {{ $item->servant->name }} <br>
                        </td>
                        <td>
                            {{ $item->total_prices }} <br>
                        </td>

                        <td>
                            {{ $item->total_servant_profit }} <br>
                        </td>
                        <td>{{ $item->total_profit }}</td>


                         <td class="text-center" style="background-color: {{ $item->status == 'active' ? 'rgb(47, 167, 227)' : 'rgb(220, 48, 48)' }}; color:#fff;">
                            {{ $item->status_text }}
                        </td>
                        <td>{{ $item->adminCreate->name ?? '-' }}</td>
                        <td>{{ $item->notes }}</td>

                       <td>
                            {{ $item->last_update }}
                       </td>

                        <td>
                            <div class="d-flex align-items-center">
                                {{-- @can('تعديل خط السير') --}}
                                @if (!empty($item->orderDetailes))
                                    <a class="btn btn-primary" href="#" wire:click.prevent="$dispatch('orderUpdate', {id: {{ $item->id }}})">تعديل</a>
                                @endif
                                {{-- @endcan --}}

                                {{-- @can('حذف خط السير') --}}
                                    <a class="btn btn-danger mx-2" href="#" wire:click.prevent="$dispatch('orderDelete', {id: {{ $item->id }}})">حذف</a>
                                {{-- @endcan --}}

                                {{-- @can('تفاصيل فاتورة المبيعات') --}}
                                <a class="btn btn-warning waves-effect waves-float waves-light" title="Show" wire:navigate
                                    href="{{ route('orders.show', $item->id) }}">
                                    المزيد
                                </a>
                                {{-- @endcan --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7">
                        <div class="text-danger text-center">لا يوجد بيانات</div>
                    </td>
                </tr>
            @endif
        </tbody>

    </table>
    <div class=" mt-2">
        {{-- @can('حذف المندوب') --}}
            {{-- <p style="color: rgb(153, 93, 51); font-weight: bold"><span style="color: red">ملحوظة</span> عند الحذف سيتم حذف المندوب اذا كان لا يحتوي علي كميات في الاصناف بداخله او الكميات  =  0 </p> --}}
        {{-- @endcan --}}
        {{ $data   ->links() }}
        {{ $data->links('pagination::bootstrap-4') }}


    </div>
</div>
