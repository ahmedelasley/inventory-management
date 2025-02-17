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
            @if(admin()->can('transfer-print'))
            <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);" onclick="openPrintReceipt({{ $order->id }})" ><i class='bx bx-printer'></i></a>

            <script type="text/javascript">
                function openPrintReceipt(id) {
                    window.open(
                        "{{ URL::to('admin/orders/print/order/') }}/" + id ,
                        "_blank",
                        "toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=800,height=800"
                    ).print();
                }
            </script>
            @endif
            @if($order->status == 'Open')
                @if($order->type == 'Pending')
                    @if(admin()->can('transfer-edit'))
                        <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                            wire:click.prevent="$dispatch('orderUpdate', { id: {{ $order->id }} })"
                        >
                            <i class='bx bx-edit-alt'></i>
                        </a>
                        
                        @livewire('admin.pages.orders.partials.edit', ['order' => $order], key('order-edit-'.time()))
                    @endif

                    @if(admin()->can('transfer-send'))
                        {{-- @livewire('admin.pages.orders.partials.delete', ['order' => $order], key('order-delete-'.time())) --}}
                        <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                            wire:click.prevent="$dispatch('orderSend', { id: {{ $order->id }} })"
                        >
                            <i class='bx bx-send'></i>
                        </a>
                        @livewire('admin.pages.orders.partials.send', ['order' => $order], key('order-send-'.time()))
                    @endif
                    
                @endif

                    {{-- <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('orderConvert', { id: {{ $order->id }} })"
                    >
                        <i class='bx bx-repost'></i>
                    </a>
                    @livewire('admin.pages.orders.partials.convert-order', ['order' => $order], key('order-convert-'.time())) --}}

                @if($order->type == 'Send')
                    @if(admin()->can('transfer-process'))
                        <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                            wire:click.prevent="$dispatch('orderProcessed', { id: {{ $order->id }} })"
                        >
                            <i class='bx bx-loader-circle'></i>
                        </a>
                        @livewire('admin.pages.orders.partials.processed', ['order' => $order], key('order-processed-'.time()))
                    @endif
                    
                @endif
                @if($order->type == 'Processed')
                    @if(admin()->can('transfer-shipped'))

                        <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                            wire:click.prevent="$dispatch('orderShipped', { id: {{ $order->id }} })"
                        >
                            <i class='bx bxs-truck'></i>
                        </a>
                        @livewire('admin.pages.orders.partials.shipped', ['order' => $order], key('order-shipped-'.time()))
                    @endif
                @endif

                @if($order->type == 'Shipped')
                    @if(admin()->can('transfer-save'))
                        <a class="btn btn-sm btn-outline-primary" href="javascript:void(0);"
                            wire:click.prevent="$dispatch('orderSave', { id: {{ $order->id }} })"
                        >
                            <i class='bx bx-save'></i>
                        </a>
                        @livewire('admin.pages.orders.partials.save', ['order' => $order], key('order-save-'.time()))
                    @endif
                @endif
            @endif
            @if($order->status == 'Open' && $order->type == 'Pending')
                @if(admin()->can('transfer-delete'))

                    <a class="btn btn-sm btn-danger" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('orderDelete', { id: {{ $order->id }} })"
                    >
                        <i class="bx bx-trash me-1"></i>
                    </a>
                @endif
            @endif
        </div>
    </div>
</div>