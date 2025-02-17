@extends('admin.layouts.master')

@section('title', 'Categories')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Categories</h5>

            @if(admin()->can('category-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>

                  @livewire('admin.pages.categories.partials.create')
            @endif

      </div>

      @if(admin()->can('category-list'))
            @livewire('admin.pages.categories.get-data')
      @endif

      @if(admin()->can('category-read'))
            @livewire('admin.pages.categories.partials.show')
      @endif

      @if(admin()->can('category-edit'))
            @livewire('admin.pages.categories.partials.edit')
      @endif

      @if(admin()->can('category-delete'))
            @livewire('admin.pages.categories.partials.delete')
      @endif

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
