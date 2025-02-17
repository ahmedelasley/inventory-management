@extends('admin.layouts.master')

@section('title', 'Roles of Supervisors')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Roles of Supervisors</h5>

    @if(admin()->can('supervisor-role-create'))
      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
      @livewire('admin.pages.roles.supervisors.partials.create')
    @endif

  </div>

  @if(admin()->can('supervisor-role-list'))
    @livewire('admin.pages.roles.supervisors.get-data')
  @endif

  @if(admin()->can('supervisor-role-read'))
    @livewire('admin.pages.roles.supervisors.partials.show')
  @endif

  @if(admin()->can('supervisor-role-edit'))
    @livewire('admin.pages.roles.supervisors.partials.edit')
  @endif

  @if(admin()->can('supervisor-role-delete'))
    @livewire('admin.pages.roles.supervisors.partials.delete')
  @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


