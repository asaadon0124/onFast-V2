<div>
    <form wire:submit.prevent="updateStatus" class="form form-horizontal">
        <select wire:model="product_status" wire:change="change_product_status($event.target.value)" class="form-select form-control-sm">
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}" @if ($status->id == ($product_status == '' ? $status_id : $product_status))
                    selected
                @endif>
                    {{ $status->name }} {{  $status->id }} {{ $product_status == '' ? $status_id : $product_status}}
                </option>
            @endforeach
        </select>

        <button type="submit" type="button" class="btn btn-info btn-sm mt-3 waves-effect waves-float waves-light {{ $update_btn != false ? '' : 'd-none' }}">
            تعديل
        </button>
    </form>
</div>
