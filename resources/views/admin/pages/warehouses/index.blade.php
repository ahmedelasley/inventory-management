@extends('admin.layouts.master')

@section('title', 'Warehouses')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Warehouses</h5>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                  Add
            </button>
            @livewire('admin.pages.warehouses.partials.create')
      
      </div>

      @livewire('admin.pages.warehouses.get-data')
      @livewire('admin.pages.warehouses.partials.show')
      @livewire('admin.pages.warehouses.partials.edit')
      @livewire('admin.pages.warehouses.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
