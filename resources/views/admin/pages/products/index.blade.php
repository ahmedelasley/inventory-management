@extends('admin.layouts.master')

@section('title', 'Products')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Products</h5>

            @if(admin()->can('product-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('admin.pages.products.partials.create')
            @endif

      </div>

      @if(admin()->can('product-list'))
            @livewire('admin.pages.products.get-data')
      @endif

      @if(admin()->can('product-read'))
            @livewire('admin.pages.products.partials.show')
      @endif

      @if(admin()->can('product-edit'))
            @livewire('admin.pages.products.partials.edit')
      @endif

      @if(admin()->can('product-delete'))
            @livewire('admin.pages.products.partials.delete')
      @endif

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
