@extends('manager.layouts.master')

@section('title', 'Menus')
@section('css')
<style>
            .action-button
  {
      position: relative;
      width: 100%;
      margin: 10px;
      padding: 0px;
      float: left;
      /* border-radius: 10%; */
      /* font-family: 'Lato', sans-serif; */
      text-decoration: none;	
      cursor:pointer;
  }
  .action-button:active
  {
      transform: translate(0px,5px);
  -webkit-transform: translate(0px,5px);
      border-bottom: 1px solid;
  }
</style>
@endsection
@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Menus</h5>

            @if(manager()->can('menu-create'))
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                    Add
                </button>
                @livewire('manager.pages.menus.partials.create')
            @endif

      </div>

      @if(manager()->can('menu-list'))
        @livewire('manager.pages.menus.get-data')
      @endif

      @if(manager()->can('menu-edit'))
        @livewire('manager.pages.menus.partials.edit')
      @endif

      @if(manager()->can('menu-delete'))
        @livewire('manager.pages.menus.partials.delete')
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
