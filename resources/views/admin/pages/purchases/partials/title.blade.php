<div class="card mb-3 p-2">

    <div class="d-flex justify-content-between">
        <div>
            <h5 class="fw-bolder fs-5 d-inline">Purchases</h5> ( {{ $purchase->code }} )
            @if($purchase->status == 'Pending')
                <span class="badge bg-primary ms-5">{{ $purchase->status }}  <i class='bx bx-lock-open'></i></span>
            @else
                <span class="badge bg-dark ms-5">{{ $purchase->status }}  <i class='bx bx-lock'></i></span>
            @endif
        </div>
        <div>
            <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);" onclick="openPrintReceipt({{ $purchase->id }})" ><i class='bx bx-printer'></i></a>

            <script type="text/javascript">
                function openPrintReceipt(id) {
                    window.open(
                        "{{ URL::to('admin/purchases/print/purchase/') }}/" + id ,
                        "_blank",
                        "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=800,height=800"
                    ).print();
                }
            </script>
            {{-- <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                <i class='bx bx-edit-alt'></i> Edit
            </button> --}}
            @if($purchase->status == 'Pending')
                <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                    wire:click.prevent="$dispatch('purchaseUpdate', { id: {{ $purchase->id }} })"
                >
                    <i class='bx bx-edit-alt'></i>
                </a>
                @livewire('admin.pages.purchases.partials.edit', ['purchase' => $purchase], key('purchase-edit-'.time()))


                <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                    wire:click.prevent="$dispatch('purchaseConvert', { id: {{ $purchase->id }} })"
                >
                    <i class='bx bx-repost'></i>
                </a>
                @livewire('admin.pages.purchases.partials.convert-purchase', ['purchase' => $purchase], key('purchase-convert-'.time()))

                <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                    wire:click.prevent="$dispatch('purchaseSave', { id: {{ $purchase->id }} })"
                >
                    <i class='bx bx-save'></i>
                </a>
                @livewire('admin.pages.purchases.partials.save', ['purchase' => $purchase], key('purchase-save-'.time()))

                <a class="btn btn-sm btn-danger" href="javascript:void(0);"
                    wire:click.prevent="$dispatch('purchaseDelete', { id: {{ $purchase->id }} })"
                >
                    <i class="bx bx-trash me-1"></i>
                </a>
                @livewire('admin.pages.purchases.partials.delete', ['purchase' => $purchase], key('purchase-delete-'.time()))
            @endif
        </div>
    </div>
</div>