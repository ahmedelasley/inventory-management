<div class="card">
    @livewire('admin.pages.sales.partials.edit-product', ['sale' => $sale])
    @livewire('admin.pages.sales.partials.delete-product', ['sale' => $sale])
    <div class="card-header p-3">
        <div class="row g-3">
            <div class="col mb-1">
                <x-text-show class='text-center' :labelValue="__('Restaurant')" :value='$sale->restaurant?->name'/>
            </div>
            <div class="col mb-1">
                @if($sale->type == 'Pending')
                    <x-text-show  class='bg-warning text-center text-white' :value='$sale->type'/>
                @elseif($sale->type == 'Completed')
                    <x-text-show  class='bg-primary text-center text-white' :value='$sale->type'/>
                @endif
            </div>
            <div class="col mb-1">
                <x-text-show  class='text-center' :labelValue="__('Client')" :value='$sale->client?->name'/>
            </div>
        </div>
        <div class="row g-3">
            <div class="col mb-1">
                <x-text-show class='text-center' :labelValue="__('Created At')" :value="$sale->created_at"/>

            </div>
            <div class="col mb-1 text-center">
                <x-text-show :labelValue="__('Items')" :value='$sale->items'/>
            </div>
            <div class="col mb-1">
                <x-text-show class='text-center' :labelValue="__('Date')" :value="$sale->date == NULL ? '' : $sale->date"/>
            </div>
        </div>
        <div class="row g-3">
            <div class="col mb-1 text-center">
                <x-text-show :labelValue="__('Sub Total')" :value='$sale->subtotal'/>
            </div>
            <div class="col mb-1 text-center">
                <x-text-show :labelValue="__('Tax')" :value='$sale->tax'/>
            </div>
            <div class="col mb-1 text-center">
                <x-text-show :labelValue="__('Total')" :value="$sale->subtotal + $sale->tax"/>
            </div>


        </div>

        <div class="row g-3">
            <div class="col mb-1 text-start">
                <x-text-show  class='text-center' :labelValue="__('Creator')" :value="$sale->creator?->name"/>
            </div>
            <div class="col mb-1 text-center">
                <x-text-show :labelValue="__('Quantities')" :value='$sale->quantities'/>
            </div>
            <div class="col mb-1 text-start">
                <x-text-show  class='text-center' :labelValue="__('Submitter')" :value="$sale->editor?->name"/>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="table-responsive text-wrap table-wrapper-scroll-y my-custom-scrollbar" style="height : calc(100vh - 630px)" >
            <table class="table table-striped table-hover table-sm text-center">
                <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                    <tr>
                        <th class="fw-bolder">#</th>
                        <th class="fw-bolder">Item</th>
                        <th class="fw-bolder">Qty</th>
                        <th class="fw-bolder">price</th>
                        <th class="fw-bolder">Total</th>
                        @if($sale->status == 'Open' && $sale->type == 'Pending' )
                            <th class="fw-bolder">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($sale->products->sortByDesc('id') as $value)
                    <tr  wire:key="product-{{$value->id}}" class="">
                        <td>{{$loop->iteration }}</td>


                        {{--  get the product name from the product table and display it in the table  --}}

                        <td>
                            <div class="d-flex justify-content-start">
                                <div class="avatar mb-2 me-1">
                                    @if($value->menu?->image)
                                        <img src="{{ $value->menu?->image }}" alt="{{ $value->menu?->name }}" class=" rounded" width="150" height="150" />
                                    @else
                                        <img src="https://placehold.co/200x100/696cff/ffffff?font=roboto&text={{ getInitials($value->menu?->name) }}" alt="{{ $value->menu?->name }}" class="w-px-30 h-auto w-30 rounded"  />
                                    @endif
                                </div>
                                <h6 class="text-primary text-wrap fw-bold text-center">{{ $value->menu?->name }}</h6>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <a href="javascript:void(0);"
                                    wire:click.prevent="increase('{{ $sale->id }}', '{{ $value->id }}')" 
                                >
                                    <i class="bx btn-success bx-plus"></i>
                                </a>
                                <span class="mx-1">{{ $value->quantity }}</span>
                                <a href="javascript:void(0);"
                                    wire:click.prevent="decrease('{{ $sale->id }}', '{{ $value->id }}')" 
                                >
                                    <i class="bx btn-danger bx-minus"></i>
                                </a>
                            </div>
                        </td>
                        <td>{{ $value->cost }} </td>
                        <td>{{ $value->quantity * $value->cost }} </td>
                       
                        @if($sale->status == 'Open' && $sale->type == 'Pending')
                            <td>
                                <a class="text-danger" href="javascript:void(0);"
                                    wire:click.prevent="$dispatch('saleItemDelete', { id: {{ $value->id }} })"
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
                <x-text-show :labelValue="__('Note')" :value='$sale->notes'/>
            {{-- </div>  
        </div> --}}
    </div>
    
    

</div>