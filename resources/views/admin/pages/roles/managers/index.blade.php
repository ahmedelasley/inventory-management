@extends('admin.layouts.master')

@section('title', 'Roles of Managers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Roles of Managers</h5>

    @if(admin()->can('manager-role-create'))
      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
      @livewire('admin.pages.roles.managers.partials.create')
    @endif

  </div>

  @if(admin()->can('manager-role-list'))
    @livewire('admin.pages.roles.managers.get-data')
  @endif

  @if(admin()->can('manager-role-read'))
    @livewire('admin.pages.roles.managers.partials.show')
  @endif

  @if(admin()->can('manager-role-edit'))
    @livewire('admin.pages.roles.managers.partials.edit')
  @endif

  @if(admin()->can('manager-role-delete'))
    @livewire('admin.pages.roles.managers.partials.delete')
  @endif

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


