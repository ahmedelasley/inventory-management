@extends('admin.layouts.master')

@section('title', 'Roles of Admins')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Roles of Admins</h5>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
  </div>

  @livewire('admin.pages.roles.admins.get-data')
  @livewire('admin.pages.roles.admins.partials.create')
  @livewire('admin.pages.roles.admins.partials.show')
  @livewire('admin.pages.roles.admins.partials.edit')
  @livewire('admin.pages.roles.admins.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


