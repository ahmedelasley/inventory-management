@extends('keeper.layouts.master')

@section('title', 'Orders')
@section('css')
@endsection
@section('content')
{{-- @dd($order->id) --}}
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Orders</h5>     
      </div>

      @livewire('keeper.pages.orders.get-data')
      {{-- @livewire('keeper.pages.orders.partials.delete') --}}

      {{-- @livewire('keeper.pages.orders.partials.save')
      @livewire('keeper.pages.orders.partials.edit') --}}
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
