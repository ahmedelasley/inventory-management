@extends('admin.layouts.master')

@section('title', 'Restaurants')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Restaurants</h5>

            @if(admin()->can('restaurant-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('admin.pages.restaurants.partials.create')
            @endif

      </div>

      @if(admin()->can('restaurant-list'))
            @livewire('admin.pages.restaurants.get-data')
      @endif

      @if(admin()->can('restaurant-read'))
            @livewire('admin.pages.restaurants.partials.show')
      @endif

      @if(admin()->can('restaurant-edit'))
            @livewire('admin.pages.restaurants.partials.edit')
      @endif

      @if(admin()->can('restaurant-delete'))
            @livewire('admin.pages.restaurants.partials.delete')
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
