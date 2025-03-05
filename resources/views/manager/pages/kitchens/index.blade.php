@extends('manager.layouts.master')

@section('title', 'Kitchens')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Kitchens</h5>

            @if(manager()->can('kitchen-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('manager.pages.kitchens.partials.create')
            @endif

      </div>

      @if(manager()->can('kitchen-list'))
            @livewire('manager.pages.kitchens.get-data')
      @endif

      @if(manager()->can('kitchen-read'))
            @livewire('manager.pages.kitchens.partials.show')
      @endif

      @if(manager()->can('kitchen-edit'))
            @livewire('manager.pages.kitchens.partials.edit')
      @endif

      @if(manager()->can('kitchen-delete'))
            @livewire('manager.pages.kitchens.partials.delete')
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
