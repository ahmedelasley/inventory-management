@extends('admin.layouts.master')

@section('title', 'Roles of Users')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Roles of Restaurant Manager</h5>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
  </div>

  @livewire('admin.pages.roles.users.get-data')
  @livewire('admin.pages.roles.users.partials.create')
  @livewire('admin.pages.roles.users.partials.show')
  @livewire('admin.pages.roles.users.partials.edit')
  @livewire('admin.pages.roles.users.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


