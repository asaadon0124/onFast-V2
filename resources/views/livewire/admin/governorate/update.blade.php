<div class="modal fade text-start modal-primary" id="updateModal" tabindex="-1" aria-hidden="true" style="display: none;"
    wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">تعديل محافظة  <span style="color: #080">{{ $name }}</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form form-horizontal" wire:submit.prevent='submit'>
                <div class="modal-body">
                    <div class="row">
                    <input type="hidden" wire:model="govID">

                        <div class="col-sm-12 mb-4">
                            <div class="form-group">
                                <label>اسم المحافظة</label>
                                <input type="text" class="form-control" placeholder="ادخل اسم المحافظة" wire:model="name">
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
