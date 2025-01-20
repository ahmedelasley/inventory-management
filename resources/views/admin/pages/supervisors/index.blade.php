@extends('admin.layouts.master')

@section('title', 'Supervisors')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Supervisors</h5>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
  </div>

  @livewire('admin.pages.supervisors.get-data')
  @livewire('admin.pages.supervisors.partials.create')
  @livewire('admin.pages.supervisors.partials.assign-role')
  @livewire('admin.pages.supervisors.partials.verify')
  @livewire('admin.pages.supervisors.partials.show')
  @livewire('admin.pages.supervisors.partials.edit')
  @livewire('admin.pages.supervisors.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
