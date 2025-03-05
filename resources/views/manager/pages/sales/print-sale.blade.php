@extends('manager.layouts.print')

@section('title', 'Print sale')
@section('css')
<style>

  </style>
@endsection
@section('content')

<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-3">
          <div>
              <h5 class="fw-bolder fs-5 d-inline">Sales</h5> ( {{ $sale->code }} )
              @if($sale->status == 'Pending')
                  <span class="badge bg-primary ms-5">{{ $sale->status }}  <i class='bx bx-lock-open'></i></span>
              @else
                  <span class="badge bg-dark ms-5">{{ $sale->status }}  <i class='bx bx-lock'></i></span>
              @endif
          </div>
      </div>
      <div class="row justify-content-md-center">
  
            <div class="col-12 mb-2">
                <div class="row g-3">
                    <div class="col mb-1">
                        <x-text-show class='text-center' :labelValue="__('Restaurant')" :value="$sale->restaurant?->name"/>
                    </div>
                    <div class="col mb-1">
                        <x-text-show class="text-center text-white {{ $sale->type == 'Pending' ? 'bg-warning' : 'bg-primary' }}" :value="$sale->type"/>
                    </div>
                    <div class="col mb-1">
                        <x-text-show class='text-center' :labelValue="__('Client')" :value="$sale->client?->name"/>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col mb-1">
                        <x-text-show class='text-center' :labelValue="__('Created At')" :value="$sale->created_at"/>
                    </div>
                    <div class="col mb-1 text-center">
                        <x-text-show :labelValue="__('Items')" :value="$sale->items"/>
                    </div>
                    <div class="col mb-1">
                        <x-text-show class='text-center' :labelValue="__('Date')" :value="$sale->date ?? ''"/>
                    </div>
                </div>
        
                <div class="row g-3">
                    <div class="col mb-1 text-center">
                        <x-text-show :labelValue="__('Sub Total')" :value="$sale->subtotal"/>
                    </div>
                    <div class="col mb-1 text-center">
                        <x-text-show :labelValue="__('Tax')" :value="$sale->tax"/>
                    </div>
                    <div class="col mb-1 text-center">
                        <x-text-show :labelValue="__('Total')" :value="$sale->subtotal + $sale->tax"/>
                    </div>
                </div>
        
                <div class="row g-3">
                    <div class="col mb-1 text-start">
                        <x-text-show class='text-center' :labelValue="__('Creator')" :value="$sale->creator?->name"/>
                    </div>
                    <div class="col mb-1 text-center">
                        <x-text-show :labelValue="__('Quantities')" :value="$sale->quantities"/>
                    </div>
                    <div class="col mb-1 text-start">
                        <x-text-show class='text-center' :labelValue="__('Submitter')" :value="$sale->editor?->name"/>
                    </div>
                </div>
                <div class="row g-1">
                    <div class="col mb-1 text-start">
                        <x-text-show :labelValue="__('Note')" :value="$sale->notes ?? ''"/>
                    </div>
                </div>
            </div>
  
  
            <div class="col-12 my-5">
                  <div class="table-responsive text-wrap" >
                    <table class="table table-striped table-hover table-sm text-center">
                        <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                            <tr>
                                <th class="fw-bolder">#</th>
                                <th class="fw-bolder">Item</th>
                                <th class="fw-bolder">Qty</th>
                                <th class="fw-bolder">Price</th>
                                <th class="fw-bolder">Total</th>
                                @if($sale->status == 'Open' && $sale->type == 'Pending' )
                                    <th class="fw-bolder">Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($sale->products?->sortByDesc('id') ?? collect() as $value)
                                <tr wire:key="product-{{ $value->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <div class="avatar mb-2 me-1">
                                                <img src="{{ $value->menu?->image ?? 'https://placehold.co/150x150/696cff/ffffff?text='.($value->menu?->name ? getInitials($value->menu?->name) : 'P') }}" 
                                                     alt="{{ $value->menu?->name }}" class="rounded" width="150" height="150" />
                                            </div>
                                            <h6 class="text-primary text-wrap fw-bold text-center">{{ $value->menu?->name ?? 'Unknown' }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between">
                                            @if($sale->status == 'Open' && $sale->type == 'Pending' )
                                                <a href="javascript:void(0);" wire:click.prevent="increase('{{ $sale->id }}', '{{ $value->id }}')">
                                                    <i class="bx btn-success bx-plus"></i>
                                                </a>
                                                <span class="mx-1">{{ $value->quantity }}</span>
                                                <a href="javascript:void(0);" wire:click.prevent="decrease('{{ $sale->id }}', '{{ $value->id }}')">
                                                    <i class="bx btn-danger bx-minus"></i>
                                                </a>
                                            @else
                                                <span>{{ $value->quantity }}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ number_format($value->cost, 2) }}</td>
                                    <td>{{ number_format($value->quantity * $value->cost, 2) }}</td>
                                    @if($sale->status == 'Open' && $sale->type == 'Pending')
                                        <td>
                                              
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"><div class="alert alert-primary" role="alert">No data to display!</div></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                  
                  </div>
            </div>
  
  
      </div>
 
  
  </div>
  <!-- / Content -->


@endsection
@section('js')
@endsection
