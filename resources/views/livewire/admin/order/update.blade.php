<div class="modal fade text-start modal-primary" id="updateModal" tabindex="-1" aria-hidden="true" style="display: none;"
    wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">اضافة خط سير جديد  </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form form-horizontal" wire:submit.prevent='submit'>
                <div class="modal-body">
                    <div class="row">

                        {{-- اسم المندوب servant_id --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>اسم المندوب</label>

                                <select class="form-control select2" wire:model="servant_id">
                                    <option selected>اسم المندوب</option>
                                    @if (isset($servants))
                                        @foreach ($servants as $servant)
                                            <option value="{{ $servant->id }}"@if ($servant->id == $servant_id)
                                                    selected
                                                @endif>{{ $servant->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @include('admins.alerts.error', ['property' => 'servant_id'])
                            </div>
                        </div>


                         {{-- ملاحظات notes --}}
                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                <label>الملاحظات</label>
                                <textarea name="" id="" cols="40" rows="2" wire:model="notes"></textarea>                                @include('admins.alerts.error', ['property' => 'total_price'])
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
