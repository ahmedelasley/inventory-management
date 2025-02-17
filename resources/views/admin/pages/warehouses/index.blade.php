@extends('admin.layouts.master')

@section('title', 'Warehouses')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Warehouses</h5>

            @if(admin()->can('warehouse-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('admin.pages.warehouses.partials.create')
            @endif

      </div>

      @if(admin()->can('warehouse-list'))
            @livewire('admin.pages.warehouses.get-data')
      @endif

      @if(admin()->can('warehouse-read'))
            @livewire('admin.pages.warehouses.partials.show')
      @endif

      @if(admin()->can('warehouse-edit'))
            @livewire('admin.pages.warehouses.partials.edit')
      @endif

      @if(admin()->can('warehouse-delete'))
            @livewire('admin.pages.warehouses.partials.delete')
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
