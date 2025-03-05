@extends('manager.layouts.master')

@section('title', 'Sales')
@section('css')
@endsection
@section('content')
{{-- @dd($order->id) --}}
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Sales</h5>
            <div>
                  @if(manager()->can('sale-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('manager.pages.sales.partials.create')
                  @endif
                  {{-- <a href="{{ route('manager.sales.create.order') }}" class="btn btn-sm btn-primary"  >
                        Create
                  </a> --}}
            </div>

      
      </div>
      @if(manager()->can('sale-list'))
            @livewire('manager.pages.sales.get-data')
      @endif
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
