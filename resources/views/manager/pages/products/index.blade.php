@extends('manager.layouts.master')

@section('title', 'Products')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Products</h5>

            @if(manager()->can('product-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('manager.pages.products.partials.create')
            @endif

      </div>

      @if(manager()->can('product-list'))
            @livewire('manager.pages.products.get-data')
      @endif

      @if(manager()->can('product-read'))
            @livewire('manager.pages.products.partials.show')
      @endif

      @if(manager()->can('product-edit'))
            @livewire('manager.pages.products.partials.edit')
      @endif

      @if(manager()->can('product-delete'))
            @livewire('manager.pages.products.partials.delete')
      @endif

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
