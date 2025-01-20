@extends('admin.layouts.print')

@section('title', 'Create Purchase')
@section('css')
<style>

  </style>
@endsection
@section('content')

<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-3">
          <div>
              <h5 class="fw-bolder fs-5 d-inline">Purchases</h5> ( {{ $purchase->code }} )
              @if($purchase->status == 'Pending')
                  <span class="badge bg-primary ms-5">{{ $purchase->status }}  <i class='bx bx-lock-open'></i></span>
              @else
                  <span class="badge bg-dark ms-5">{{ $purchase->status }}  <i class='bx bx-lock'></i></span>
              @endif
          </div>
      </div>
      <div class="row justify-content-md-center">
  
            <div class="col-12 mb-2">
                  <div class="row g-2">
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Supplier')" :value='$purchase->supplier?->name'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Warehouse Branch')" :value='$purchase->warehouse?->name'/>
                  </div>
                  </div>
                  <div class="row g-2">
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Invoice Number')" :value='$purchase->invoice_number'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Invoice Date')" :value='$purchase->invoice_date'/>
                  </div>
                  </div>
                  <div class="row g-2">
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Business Date')" :value='$purchase->business_date'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Number of Items')" :value='$purchase->items'/>
                  </div>
                  </div>
                  <div class="row g-4">
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Creator')" :value='$purchase->createable?->name'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Created at')" :value='$purchase->created_at'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Submitter')" :value='$purchase->updateable?->name'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Submitted at')" :value='$purchase->updated_at'/>
                  </div>
                  </div>

                  <div class="row g-5">
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Quantities')" :value='$purchase->quantities'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('SubTotal')" :value='$purchase->subtotal'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Total Tax')" :value='$purchase->tax'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Additional Cost')" :value='$purchase->additional_cost'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Discount')" :value='$purchase->discount'/>
                  </div>
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Total')" :value='$purchase->subtotal + $purchase->tax + $purchase->additional_cost - $purchase->discount'/>
                  </div>
                  </div>
                  <div class="row">
                  <div class="col mb-3">
                        <x-text-show :labelValue="__('Note')" :value='$purchase->notes'/>
                  </div>
                  </div>
            </div>
  
  
            <div class="col-12 mb-5">
                  <div class="table-responsive text-wrap" >
                  <table class="table table-striped table-hover table-sm text-center">
                        <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                        <tr>
                              <th class="fw-bolder fs-6">#</th>
                              <th class="fw-bolder fs-6">Name</th>
                              <th class="fw-bolder fs-6">SKU</th>
                              <th class="fw-bolder fs-6">Production Date</th>
                              <th class="fw-bolder fs-6">Expiration Date</th>
                              <th class="fw-bolder fs-6">Quantity</th>
                              <th class="fw-bolder fs-6">Unit Cost</th>
                              <th class="fw-bolder fs-6">Total Cost</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                              @forelse ($purchase->products as $value)
                              <tr  wire:key="product-{{$value->id}}">
                              <td>{{$loop->iteration }}</td>
                              <td><strong>{{ $value->product?->name }}</strong></td>
                              <td><strong>{{ $value->product?->sku }}</strong></td>
                              <td><strong class="badge rounded-pill bg-success">{{ ($value->production_date ==NULL) ? "" : \Carbon\Carbon::parse($value->production_date)->format('d-m-Y') }}</strong></td>
                              <td><strong class="badge rounded-pill bg-danger">{{ ($value->expiration_date ==NULL) ? "" : \Carbon\Carbon::parse($value->expiration_date)->format('d-m-Y') }}</strong></td>
                              <td><strong>{{ $value->quantity }}</strong></td>
                              <td><strong>{{ $value->cost }}</strong></td>
                              <td><strong>{{ $value->quantity * $value->cost }}</strong></td>

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
