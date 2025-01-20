@extends('admin.layouts.master')

@section('title', 'Admins')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Admins</h5>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
  </div>

  @livewire('admin.pages.admins.get-data')
  @livewire('admin.pages.admins.partials.create')
  @livewire('admin.pages.admins.partials.assign-role')
  @livewire('admin.pages.admins.partials.verify')
  @livewire('admin.pages.admins.partials.show')
  @livewire('admin.pages.admins.partials.edit')
  @livewire('admin.pages.admins.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


