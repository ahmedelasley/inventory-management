@extends('manager.layouts.master')

@section('title', 'Warehouses')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Warehouses</h5>

            @if(manager()->can('warehouse-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('manager.pages.warehouses.partials.create')
            @endif

      </div>

      @if(manager()->can('warehouse-list'))
            @livewire('manager.pages.warehouses.get-data')
      @endif

      @if(manager()->can('warehouse-read'))
            @livewire('manager.pages.warehouses.partials.show')
      @endif

      @if(manager()->can('warehouse-edit'))
            @livewire('manager.pages.warehouses.partials.edit')
      @endif

      @if(manager()->can('warehouse-delete'))
            @livewire('manager.pages.warehouses.partials.delete')
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
