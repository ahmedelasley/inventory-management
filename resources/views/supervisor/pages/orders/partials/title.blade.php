<div class="card mb-3 p-2">

    <div class="d-flex justify-content-between">
        <div>
            <h5 class="fw-bolder fs-5 d-inline">Order </h5> [ {{ $order->code }} ]
            @if($order->status == 'Open')
                <span class="badge bg-primary ms-5">{{ $order->status }}  <i class='bx bx-lock-open'></i></span>
            @else
                <span class="badge bg-dark ms-5">{{ $order->status }}  <i class='bx bx-lock'></i></span>
            @endif
        </div>
        <div>
            <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);" onclick="openPrintReceipt({{ $order->id }})" ><i class='bx bx-printer'></i></a>

            <script type="text/javascript">
                function openPrintReceipt(id) {
                    window.open(
                        "{{ URL::to('supervisor/orders/print/order/') }}/" + id ,
                        "_blank",
                        "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=800,height=800"
                    ).print();
                }
            </script>
            {{-- <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                <i class='bx bx-edit-alt'></i> Edit
            </button> --}}
            @if($order->status == 'Open')
                @if($order->type == 'Pending')
                    <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('orderUpdate', { id: {{ $order->id }} })"
                    >
                        <i class='bx bx-edit-alt'></i>
                    </a>
                    @livewire('supervisor.pages.orders.partials.edit', ['order' => $order], key('order-edit-'.time()))
                    <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('orderSend', { id: {{ $order->id }} })"
                    >
                        <i class='bx bx-send'></i>
                    </a>
                    @livewire('supervisor.pages.orders.partials.send-order', ['order' => $order], key('order-send-'.time()))

                    <a class="btn btn-sm btn-danger" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('orderDelete', { id: {{ $order->id }} })"
                    >
                        <i class="bx bx-trash me-1"></i>
                    </a>
                    @livewire('supervisor.pages.orders.partials.delete', ['order' => $order], key('order-delete-'.time()))

                @endif

                @if($order->type == 'Shipped')
                    <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('orderSave', { id: {{ $order->id }} })"
                    >
                        <i class='bx bx-save'></i>
                    </a>
                    @livewire('supervisor.pages.orders.partials.save', ['order' => $order], key('order-save-'.time()))
                @endif

            @endif
        </div>
    </div>
</div>