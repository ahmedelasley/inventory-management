@extends('supervisor.layouts.master')

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
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('supervisor.pages.orders.partials.create')
      
                  {{-- <a href="{{ route('supervisor.orders.create.order') }}" class="btn btn-sm btn-primary"  >
                        Create
                  </a> --}}
            </div>

      
      </div>

      @livewire('supervisor.pages.orders.get-data')
      {{-- @livewire('supervisor.pages.orders.partials.delete') --}}

      {{-- @livewire('supervisor.pages.orders.partials.save')
      @livewire('supervisor.pages.orders.partials.edit') --}}
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
