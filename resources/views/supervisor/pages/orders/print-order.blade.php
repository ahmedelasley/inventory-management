@extends('supervisor.layouts.print')

@section('title', 'Print Order')
@section('css')
<style>

  </style>
@endsection
@section('content')

<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-3">
          <div>
              <h5 class="fw-bolder fs-5 d-inline">orders</h5> ( {{ $order->code }} )
              @if($order->status == 'Pending')
                  <span class="badge bg-primary ms-5">{{ $order->status }}  <i class='bx bx-lock-open'></i></span>
              @else
                  <span class="badge bg-dark ms-5">{{ $order->status }}  <i class='bx bx-lock'></i></span>
              @endif
          </div>
      </div>
      <div class="row justify-content-md-center">
  
            <div class="col-12 mb-2">
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
  
  
            <div class="col-12 my-5">
                  <div class="table-responsive text-wrap" >
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
                                </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                              @forelse ($order->products as $value)
                              <tr  wire:key="product-{{$value->id}}" class="{{ $value->stock?->quantity < $value->quantity_request ? 'table-danger' : '' }}">
                                    <td>{{$loop->iteration }}</td>           
                                    <td>{{ $value->stock?->product?->name }}</td>
                                    <td>{{ $value->stock?->product?->sku }}</td>
                                    <td>{{ $value->quantity_request }} {{ $value->stock?->product?->storge_unit }}</td>
                                    <td>{{ $value->stock?->quantity }} {{ $value->stock?->product?->storge_unit }}</td>
                                    @if($order->type != 'Pending')
                                    <td>{{ $value->quantity_available }} {{ $value->stock?->product?->storge_unit }}</td>
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
  
  
      </div>
 
  
  </div>
  <!-- / Content -->


@endsection
@section('js')
@endsection
