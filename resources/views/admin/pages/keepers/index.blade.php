@extends('admin.layouts.master')

@section('title', 'Keepers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Keepers</h5>
    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
  </div>

  @livewire('admin.pages.keepers.get-data')
  @livewire('admin.pages.keepers.partials.create')
  @livewire('admin.pages.keepers.partials.assign-role')
  @livewire('admin.pages.keepers.partials.verify')
  @livewire('admin.pages.keepers.partials.show')
  @livewire('admin.pages.keepers.partials.edit')
  @livewire('admin.pages.keepers.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


