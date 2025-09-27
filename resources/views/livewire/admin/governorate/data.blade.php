<div class="table-responsive" wire:ignore.self>

    <div class="card-header ">
        <input type="text" wire:model.live="search" class="form-control w-25"
            placeholder="بحث">

        {{-- @can('اضافة مخزن جديد') --}}
            <button class="btn btn-primary" wire:click.prevent="$dispatch('governorateCreate')">اضافة</button>
        {{-- @endcan --}}

    </div>
    <table class="table table-bordered table-striped dataTable" style="margin: 10px">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>الحالة </th>
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
                        <td>{{ $item->name }}</td>

                        <td class="text-center" style="background-color: {{ $item->status == 'active' ? 'rgb(47, 167, 227)' : 'rgb(220, 48, 48)' }}; color:#fff;">
                            {{ $item->status_text }}
                        </td>

                        <td>{{ $item->adminCreate->name ?? '-' }}</td>

                       <td>
                            {{ $item->last_update }}
                       </td>

                        <td>
                            <div class="d-flex align-items-center">
                                {{-- @can('تعديل المخزن') --}}
                                    <a class="btn btn-primary" href="#" wire:click.prevent="$dispatch('governorateUpdate', {id: {{ $item->id }}})">تعديل</a>
                                {{-- @endcan --}}

                                {{-- @can('حذف المخزن') --}}
                                    <a class="btn btn-danger mx-2" href="#" wire:click.prevent="$dispatch('governorateDelete', {id: {{ $item->id }}})">حذف</a>
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
        {{-- @can('حذف المخزن') --}}
            {{-- <p style="color: rgb(153, 93, 51); font-weight: bold"><span style="color: red">ملحوظة</span> عند الحذف سيتم حذف المخزن اذا كان لا يحتوي علي كميات في الاصناف بداخله او الكميات  =  0 </p> --}}
        {{-- @endcan --}}
        {{ $data->links() }}


    </div>
</div>
