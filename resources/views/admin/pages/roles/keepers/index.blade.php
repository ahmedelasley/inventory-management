@extends('admin.layouts.master')

@section('title', 'Roles of Keepers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Roles of Keepers</h5>

    @if(admin()->can('keeper-role-create'))
      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
      @livewire('admin.pages.roles.keepers.partials.create')
    @endif

  </div>

  @if(admin()->can('keeper-role-list'))
    @livewire('admin.pages.roles.keepers.get-data')
  @endif

  @if(admin()->can('keeper-role-read'))
    @livewire('admin.pages.roles.keepers.partials.show')
  @endif

  @if(admin()->can('keeper-role-edit'))
    @livewire('admin.pages.roles.keepers.partials.edit')
  @endif

  @if(admin()->can('keeper-role-delete'))
    @livewire('admin.pages.roles.keepers.partials.delete')
  @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


