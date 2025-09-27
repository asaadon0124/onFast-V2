<div class="modal fade text-start modal-primary" id="deleteModal" tabindex="-1" aria-hidden="true" style="display: none;"
    wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel110">حذف الشحنة من خط السير </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form form-horizontal" wire:submit.prevent='submit'>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-6 mb-4">
                            <div class="form-group">
                                    @if (isset($orderDetailes))
                                        <h3>هل تريد حذف الشحنة  <span style="color: #f00;">{{$orderDetailes->product->tracking_number}}</span></h3>
                                    @endif

                                     @error('product_status')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" type="button"
                        class="btn btn-warning waves-effect waves-float waves-light">حذف</button>
                </div>
            </form>
        </div>
    </div>
</div>
