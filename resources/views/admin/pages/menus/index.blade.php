@extends('admin.layouts.master')

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
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                  Add
            </button>
            @livewire('admin.pages.menus.partials.create')
      
      </div>

      @livewire('admin.pages.menus.get-data')
      {{-- @livewire('admin.pages.menus.partials.show') --}}
      @livewire('admin.pages.menus.partials.edit')
      @livewire('admin.pages.menus.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
