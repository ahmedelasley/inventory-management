@extends('manager.layouts.master')

@section('title', 'Restaurants')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Restaurants</h5>

            @if(manager()->can('restaurant-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('manager.pages.restaurants.partials.create')
            @endif

      </div>

      @if(manager()->can('restaurant-list'))
            @livewire('manager.pages.restaurants.get-data')
      @endif

      @if(manager()->can('restaurant-read'))
            @livewire('manager.pages.restaurants.partials.show')
      @endif

      @if(manager()->can('restaurant-edit'))
            @livewire('manager.pages.restaurants.partials.edit')
      @endif

      @if(manager()->can('restaurant-delete'))
            @livewire('manager.pages.restaurants.partials.delete')
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
