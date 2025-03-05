@extends('manager.layouts.master')

@section('title', 'Categories')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Categories</h5>

            @if(manager()->can('category-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>

                  @livewire('manager.pages.categories.partials.create')
            @endif

      </div>

      @if(manager()->can('category-list'))
            @livewire('manager.pages.categories.get-data')
      @endif

      @if(manager()->can('category-read'))
            @livewire('manager.pages.categories.partials.show')
      @endif

      @if(manager()->can('category-edit'))
            @livewire('manager.pages.categories.partials.edit')
      @endif

      @if(manager()->can('category-delete'))
            @livewire('manager.pages.categories.partials.delete')
      @endif

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
