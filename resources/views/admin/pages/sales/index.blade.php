@extends('admin.layouts.master')

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
                  @if(admin()->can('sale-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('admin.pages.sales.partials.create')
                  @endif
                  {{-- <a href="{{ route('admin.sales.create.order') }}" class="btn btn-sm btn-primary"  >
                        Create
                  </a> --}}
            </div>

      
      </div>
      @if(admin()->can('sale-list'))
            @livewire('admin.pages.sales.get-data')
      @endif
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
