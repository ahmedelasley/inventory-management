@extends('admin.layouts.master')

@section('title', 'Roles of Managers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Roles of Managers</h5>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
  </div>

  @livewire('admin.pages.roles.managers.get-data')
  @livewire('admin.pages.roles.managers.partials.create')
  @livewire('admin.pages.roles.managers.partials.show')
  @livewire('admin.pages.roles.managers.partials.edit')
  @livewire('admin.pages.roles.managers.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


