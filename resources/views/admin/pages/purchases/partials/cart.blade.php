<div class="card">
    @livewire('admin.pages.purchases.partials.edit-product', ['purchase' => $purchase])
    @livewire('admin.pages.purchases.partials.delete-product', ['purchase' => $purchase])
    <div class="card-header p-3">
        <div class="row g-3 text-center">
            <div class="col mb-1">
                <x-text-input id="total" type="text" class="form-control bg-white text-center" value="{{ $purchase->supplier?->name  }}" readonly/>
            </div>
            <div class="col mb-1">
                @if($purchase->type == 'Purchasing')
                    <x-text-input id="total" type="text" class="form-control bg-primary text-center text-white" value="{{ $purchase->type  }}" readonly/>
                @elseif($purchase->type == 'Return')
                    <x-text-input id="total" type="text" class="form-control bg-danger text-center text-white" value="{{ $purchase->type  }}" readonly/>
                @elseif($purchase->type == 'Draft')
                    <x-text-input id="total" type="text" class="form-control bg-secondary text-center text-white" value="{{ $purchase->type  }}" readonly/>
                @endif
            </div>
            <div class="col mb-1">
                <x-text-input id="total" type="text" class="form-control bg-white text-center" value="{{ $purchase->warehouse?->name  }}" readonly/>
            </div>
        </div>
        <div class="row g-3 text-center">
            <div class="col mb-1">
                <x-text-input id="total" type="text" class="form-control bg-white text-center" value="{{ \Carbon\Carbon::parse($purchase->invoice_date)->format('d-m-Y')  }}" readonly/>
            </div>
            <div class="col mb-1">
                <x-text-input id="total" type="text" class="form-control bg-white text-center text-primary" value="{{ $purchase->invoice_number  }}" readonly/>
            </div>
            <div class="col mb-1">
                <x-text-input id="total" type="text" class="form-control bg-white text-center" value="{{ \Carbon\Carbon::parse($purchase->business_date)->format('d-m-Y')  }}" readonly/>
            </div>
        </div>

        <div class="row g-3">
            <div class="col mb-1 text-start">
                {{ __('Creator') }} : {{ $purchase->createable?->name  }}
            </div>
            <div class="col mb-1 text-end">
                {{ __('Submitter') }} : {{ $purchase->updateable?->name  }}
            </div>
        </div>

    </div>
    <div class="card-body">
        @if(admin()->can('purchasing-all-items'))
            <div class="table-responsive text-wrap table-wrapper-scroll-y my-custom-scrollbar" style="height : calc(100vh - 300px)" >
                <table class="table table-striped table-hover table-sm text-center">
                    <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                    <tr>
                        <th class="fw-bolder">#</th>
                        <th class="fw-bolder">Name</th>
                        <th class="fw-bolder">SKU</th>
                        <th class="fw-bolder">Prod</th>
                        <th class="fw-bolder">Expir</th>
                        <th class="fw-bolder">Qty</th>
                        <th class="fw-bolder">Cost</th>
                        <th class="fw-bolder">Total</th>
                        @if($purchase->status == 'Pending')
                            <th class="fw-bolder">Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($purchase->products as $value)
                        <tr  wire:key="product-{{$value->id}}">
                            <td>{{$loop->iteration }}</td>
                            <td>{{ $value->product?->name }}</td>
                            <td>{{ $value->product?->sku }}</td>
                            <td><span class="badge rounded-pill bg-success">{{ ($value->production_date ==NULL) ? "" : \Carbon\Carbon::parse($value->production_date)->format('d-m-Y') }}</span></td>
                            <td><span class="badge rounded-pill bg-danger">{{ ($value->expiration_date ==NULL) ? "" : \Carbon\Carbon::parse($value->expiration_date)->format('d-m-Y') }}</span></td>
                            <td>{{ $value->quantity }}</td>
                            <td>{{ $value->cost }}</td>
                            <td>{{ $value->quantity * $value->cost }}</td>
                            <td>
                                @if($purchase->status == 'Pending')
                                    @if(admin()->can('purchasing-edit-item'))
                                        <a class="text-success" href="javascript:void(0);"
                                            wire:click.prevent="$dispatch('purchaseItemUpdate', { id: {{ $value->id }} })"
                                        >
                                            <i class="bx bx-edit-alt me-1"></i>
                                        </a>
                                    @endif
                                    @if(admin()->can('purchasing-delete-item'))
                                        <a class="text-danger" href="javascript:void(0);"
                                            wire:click.prevent="$dispatch('purchaseItemDelete', { id: {{ $value->id }} })"
                                        >
                                            <i class="bx bx-trash me-1"></i>
                                        </a> 
                                    @endif 
                                @endif
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <th colspan="10"><div class="alert alert-primary" role="alert">No data to display!</div></th>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            
            </div>
        @endif  
    </div>
    <div class="card-footer">
        <div class="row g-2">
            <div class="col mb-2">
                <x-text-show :labelValue="__('Number of Items')" :value='$purchase->items'/>
            </div>
            <div class="col mb-2">
                <x-text-show :labelValue="__('Quantities')" :value='$purchase->quantities'/>
            </div>
        </div>
        <div class="row g-2">
            <div class="col mb-2">
                <x-text-show :labelValue="__('SubTotal')" :value='$purchase->subtotal'/>
                </div>
            <div class="col mb-2">
                <x-text-show :labelValue="__('Tax')" :value='$purchase->tax'/>
            </div>
        </div>

        <div class="row g-2">
            <div class="col mb-2">
                <x-text-show :labelValue="__('Additional Cost')" :value='$purchase->additional_cost'/>
                </div>
            <div class="col mb-2">
                <x-text-show :labelValue="__('Discount')" :value='$purchase->discount'/>
            </div>
        </div>
        <div class="row g-2">
            <div class="col mb-2">
                <x-text-show :labelValue="__('Total')" :value='$purchase->subtotal + $purchase->tax + $purchase->additional_cost - $purchase->discount'/>
            </div>
        </div>
        <div class="row g-2">
            <div class="col">
                <x-text-show :labelValue="__('Note')" :value='$purchase->notes'/>
            </div>  
        </div>
    </div>
    
    

</div>