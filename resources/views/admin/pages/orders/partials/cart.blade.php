<div class="card">
    @livewire('admin.pages.orders.partials.edit-product', ['order' => $order])
    @livewire('admin.pages.orders.partials.delete-product', ['order' => $order])
    <div class="card-header p-3">
        <div class="row g-3">
            <div class="col mb-1">
                <x-text-show class='text-center' :labelValue="__('Kitchen')" :value='$order->kitchen?->name'/>
            </div>
            <div class="col mb-1">
                @if($order->type == 'Pending')
                    <x-text-show  class='bg-warning text-center text-white' :value='$order->type'/>
                @elseif($order->type == 'Send')
                    <x-text-show  class='bg-info text-center text-white' :value='$order->type'/>
                @elseif($order->type == 'Processed')
                    <x-text-show  class='bg-success text-center text-white' :value='$order->type'/>
                @elseif($order->type == 'Shipped')
                    <x-text-show  class='bg-dark text-center text-white' :value='$order->type'/>
                @elseif($order->type == 'Received')
                    <x-text-show  class='bg-primary text-center text-white' :value='$order->type'/>
                @endif
            </div>
            <div class="col mb-1">
                <x-text-show  class='text-center' :labelValue="__('Warehouse')" :value='$order->warehouse?->name'/>
            </div>
        </div>
        <div class="row g-3">
            <div class="col mb-1">
                <x-text-show class='text-center' :labelValue="__('Request Date')" :value="$order->request_date == NULL ? '' : $order->request_date"/>

            </div>
            <div class="col mb-1 text-center">
                <x-text-show :labelValue="__('Number of Items')" :value='$order->items'/>
            </div>
            <div class="col mb-1">
                <x-text-show class='text-center' :labelValue="__('Response Date')" :value="$order->response_date == NULL ? '' : $order->response_date"/>
            </div>
        </div>

        <div class="row g-3">
            <div class="col mb-1 text-start">
                <x-text-show  class='text-center' :labelValue="__('Creator')" :value='$order->createable?->name'/>
            </div>
            <div class="col mb-1 text-center">
                <x-text-show :labelValue="__('Quantities')" :value='$order->quantities'/>
            </div>
            <div class="col mb-1 text-start">
                <x-text-show  class='text-center' :labelValue="__('Submitter')" :value='$order->updateable?->name'/>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive text-wrap table-wrapper-scroll-y my-custom-scrollbar" style="height : calc(100vh - 530px)" >
            <table class="table table-striped table-hover table-sm text-center">
                <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                    <tr>
                        <th class="fw-bolder">#</th>
                        <th class="fw-bolder">Name</th>
                        <th class="fw-bolder">SKU</th>
                        <th class="fw-bolder">Request Qty</th>
                        <th class="fw-bolder">Stock Qty</th>
                        @if($order->type != 'Pending')
                            <th class="fw-bolder">Send Qty</th>
                        @endif
                        {{-- <th class="fw-bolder">Cost</th>
                        <th class="fw-bolder">Total</th> --}}
                        @if($order->status == 'Open' && ( $order->type == 'Pending' || $order->type == 'Processed' ))
                            <th class="fw-bolder">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($order->products as $value)
                    <tr  wire:key="product-{{$value->id}}" class="{{ $value->stock?->quantity < $value->quantity_request ? 'table-danger' : '' }}">
                        <td>{{$loop->iteration }}</td>


                        {{--  get the product name from the product table and display it in the table  --}}

                        <td>{{ $value->stock?->product?->name }}</td>
                        <td>{{ $value->stock?->product?->sku }}</td>
                        <td>{{ $value->quantity_request }} {{ $value->stock?->product?->storge_unit }}</td>
                        <td>{{ $value->stock?->quantity }} {{ $value->stock?->product?->storge_unit }}</td>
                        @if($order->type != 'Pending')
                        <td>{{ $value->quantity_available }} {{ $value->stock?->product?->storge_unit }}</td>
                        @endif
                        {{-- <td>{{ $value->cost }}</td>
                        <td>{{ $value->quantity * $value->cost }}</td> --}}
                        @if($order->status == 'Open' && ( $order->type == 'Pending' || $order->type == 'Processed' ))  
                            <td>
                                <a class="text-success" href="javascript:void(0);"
                                    wire:click.prevent="$dispatch('orderItemUpdate', { id: {{ $value->id }} })"
                                >
                                    <i class="bx bx-edit-alt me-1"></i>
                                </a>
                                <a class="text-danger" href="javascript:void(0);"
                                    wire:click.prevent="$dispatch('orderItemDelete', { id: {{ $value->id }} })"
                                >
                                    <i class="bx bx-trash me-1"></i>
                                </a>  
                            </td>
                        @endif
                    </tr>
                    @empty
                        <tr>
                            <th colspan="10"><div class="alert alert-primary" role="alert">No data to display!</div></th>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        
        </div>

    </div>
    <div class="card-footer">
        {{-- <div class="row g-1">
            <div class="col"> --}}
                <x-text-show :labelValue="__('Note')" :value='$order->notes'/>
            {{-- </div>  
        </div> --}}
    </div>
    
    

</div>