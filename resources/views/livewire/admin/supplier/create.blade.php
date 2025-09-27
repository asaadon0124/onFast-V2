<div class="modal fade text-start modal-primary" id="createModal" tabindex="-1" aria-hidden="true" style="display: none;"
    wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">اضافة مورد جديد  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form form-horizontal" wire:submit.prevent='submit'>
                <div class="modal-body">
                    <div class="row">

                        {{-- اسم المورد NAME --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>اسم المورد</label>
                                 <input type="text" class="form-control" placeholder="ادخل اسم المورد" wire:model="name">
                                @include('admins.alerts.error', ['property' => 'name'])
                            </div>
                        </div>


                        {{-- اسم المحافظة governorate_id --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>اسم المحافظة</label>
                                 <select class="form-control select2" wire:model="governorate_id" wire:change="change_gov($event.target.value)">
                                    <option selected>اسم المحافظة</option>
                                    @if (isset($governorates))
                                        @foreach ($governorates as $governorate)
                                            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('admins.alerts.error', ['property' => 'governorate_id'])
                            </div>
                        </div>


                        {{-- اسم المدينة city_id --}}
                        <div class="col-sm-6 mb-4">
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


                          {{-- عنوان المورد ADDRESS --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>عنوان المورد</label>
                                <input type="text" class="form-control" placeholder="ادخل عنوان المورد" wire:model="adress">
                                @include('admins.alerts.error', ['property' => 'adress'])
                            </div>
                        </div>


                        {{-- تليفون المورد PHONE --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>تليفون المورد</label>
                                <input type="number" class="form-control" placeholder="ادخل تليفون المورد" wire:model="phone">
                                @include('admins.alerts.error', ['property' => 'phone'])
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
