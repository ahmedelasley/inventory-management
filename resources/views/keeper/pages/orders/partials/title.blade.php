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
                        "{{ URL::to('keeper/orders/print/order/') }}/" + id ,
                        "_blank",
                        "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=800,height=800"
                    ).print();
                }
            </script>

            @if($order->status == 'Open')
                @if($order->type != 'Shipped')
                {{-- <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                    wire:click.prevent="$dispatch('orderConvert', { id: {{ $order->id }} })"
                >
                    <i class='bx bx-repost'></i>
                </a>

                @livewire('keeper.pages.orders.partials.convert-order', ['order' => $order], key('order-convert-'.time())) --}}

                @endif
                @if($order->type == 'Send')
                    <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('orderProcessed', { id: {{ $order->id }} })"
                    >
                        <i class='bx bx-loader-circle'></i>
                    </a>
                    @livewire('keeper.pages.orders.partials.processed', ['order' => $order], key('order-processed-'.time()))
                @endif
                @if($order->type == 'Processed')
                    <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('orderShipped', { id: {{ $order->id }} })"
                    >
                        <i class='bx bxs-truck'></i>
                    </a>
                    @livewire('keeper.pages.orders.partials.shipped', ['order' => $order], key('order-shipped-'.time()))
                @endif
            @endif
        </div>
    </div>
</div>