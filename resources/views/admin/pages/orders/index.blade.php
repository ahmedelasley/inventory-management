@extends('admin.layouts.master')

@section('title', 'Orders')
@section('css')
@endsection
@section('content')
{{-- @dd($order->id) --}}
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">orders</h5>
            <div>
                  @if(admin()->can('transfer-create'))
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                              Add
                        </button>
                        @livewire('admin.pages.orders.partials.create')
                  @endif
            </div>

      
      </div>
      @if(admin()->can('transfer-list'))
            @livewire('admin.pages.orders.get-data')
      @endif  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
