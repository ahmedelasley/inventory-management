@extends('admin.layouts.master')

@section('title', 'Kitchens')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Kitchens</h5>

            @if(admin()->can('kitchen-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('admin.pages.kitchens.partials.create')
            @endif

      </div>

      @if(admin()->can('kitchen-list'))
            @livewire('admin.pages.kitchens.get-data')
      @endif

      @if(admin()->can('kitchen-read'))
            @livewire('admin.pages.kitchens.partials.show')
      @endif

      @if(admin()->can('kitchen-edit'))
            @livewire('admin.pages.kitchens.partials.edit')
      @endif

      @if(admin()->can('kitchen-delete'))
            @livewire('admin.pages.kitchens.partials.delete')
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
