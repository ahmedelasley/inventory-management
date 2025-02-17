@extends('admin.layouts.master')

@section('title', 'Suppliers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Suppliers</h5>
            @endif

            @if(admin()->can('supplier-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('admin.pages.suppliers.partials.create')
            @endif

      </div>

      @if(admin()->can('supplier-list'))
            @livewire('admin.pages.suppliers.get-data')
      @endif

      @if(admin()->can('supplier-read'))
            @livewire('admin.pages.suppliers.partials.show')
      @endif

      @if(admin()->can('supplier-edit'))
            @livewire('admin.pages.suppliers.partials.edit')
      @endif

      @if(admin()->can('supplier-delete'))
            @livewire('admin.pages.suppliers.partials.delete')
      @endif

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
