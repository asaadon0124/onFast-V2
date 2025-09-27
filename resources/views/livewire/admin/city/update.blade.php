<div class="modal fade text-start modal-primary" id="updateModal" tabindex="-1" aria-hidden="true" style="display: none;"
    wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">تعديل مدينة   </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form form-horizontal" wire:submit.prevent='submit'>
                <div class="modal-body">
                    <div class="row">

                        {{-- اسم المحافظة governorate_id --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>اسم المحافظة</label>
                                <select class="form-control select2" wire:model="governorate_id">
                                    <option selected>اسم المحافظة</option>
                                    @if (isset($governorates))
                                        @foreach ($governorates as $governorate)
                                            <option value="{{ $governorate->id }}"  @if ($governorate->id == $governorate_id)
                                                    selected
                                                @endif>{{ $governorate->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('admins.alerts.error', ['property' => 'governorate_id'])
                            </div>
                        </div>


                        {{-- اسم المدينة name --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>اسم المدينة</label>
                                <input type="text" class="form-control" placeholder="ادخل اسم المدينة" wire:model="name">
                                @include('admins.alerts.error', ['property' => 'name'])

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" type="button"
                        class="btn btn-info waves-effect waves-float waves-light">تعديل</button>
                </div>
            </form>
        </div>
    </div>
</div>
