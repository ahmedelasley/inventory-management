@extends('manager.layouts.master')

@section('title', 'Suppliers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Suppliers</h5>

            @if(manager()->can('supplier-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('manager.pages.suppliers.partials.create')
            @endif

      </div>

      @if(manager()->can('supplier-list'))
            @livewire('manager.pages.suppliers.get-data')
      @endif

      @if(manager()->can('supplier-read'))
            @livewire('manager.pages.suppliers.partials.show')
      @endif

      @if(manager()->can('supplier-edit'))
            @livewire('manager.pages.suppliers.partials.edit')
      @endif

      @if(manager()->can('supplier-delete'))
            @livewire('manager.pages.suppliers.partials.delete')
      @endif

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
