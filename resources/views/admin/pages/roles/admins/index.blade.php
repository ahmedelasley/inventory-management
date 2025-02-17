@extends('admin.layouts.master')

@section('title', 'Roles of Admins')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Roles of Admins</h5>

    @if(admin()->can('administration-role-create'))
      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
      @livewire('admin.pages.roles.admins.partials.create')
    @endif

  </div>

  @if(admin()->can('administration-role-list'))
    @livewire('admin.pages.roles.admins.get-data')
  @endif

  @if(admin()->can('administration-role-read'))
    @livewire('admin.pages.roles.admins.partials.show')
  @endif

  @if(admin()->can('administration-role-edit'))
    @livewire('admin.pages.roles.admins.partials.edit')
  @endif

  @if(admin()->can('administration-role-delete'))
    @livewire('admin.pages.roles.admins.partials.delete')
  @endif

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


