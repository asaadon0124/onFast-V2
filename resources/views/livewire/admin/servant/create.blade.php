<div class="modal fade text-start modal-primary" id="createModal" tabindex="-1" aria-hidden="true" style="display: none;"
    wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">اضافة مندوب جديد  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form form-horizontal" wire:submit.prevent='submit'>
                <div class="modal-body">
                    <div class="row">

                        {{-- اسم المندوب NAME --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>اسم المندوب</label>
                                 <input type="text" class="form-control" placeholder="ادخل اسم المندوب" wire:model="name">
                                @include('admins.alerts.error', ['property' => 'name'])
                            </div>
                        </div>


                        {{-- عنوان المندوب ADDRESS --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>عنوان المندوب</label>
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


                         {{-- كلمة سر المورد PASSWORD --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>كلمة سر المورد</label>
                                <input type="text" class="form-control" placeholder="ادخل كللمة سر المورد" wire:model="password" required>
                                @include('admins.alerts.error', ['property' => 'password'])
                            </div>
                        </div>


                        {{-- password_confirmation  PASSWORDagain --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>تاكيد كلمة سر المورد</label>
                                <input type="text" class="form-control" placeholder="تاكيد كللمة سر المورد" wire:model="password_confirmation" required>
                                @include('admins.alerts.error', ['property' => 'password_confirmation'])
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
