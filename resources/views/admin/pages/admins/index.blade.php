@extends('admin.layouts.master')

@section('title', 'Admins')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Admins</h5>
    @if(admin()->can('administration-create'))
      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
    @endif
  </div>

  @if(admin()->can('administration-list'))
    @livewire('admin.pages.admins.get-data')
  @endif

  @if(admin()->can('administration-create'))
    @livewire('admin.pages.admins.partials.create')
  @endif

  @if(admin()->can('administration-assign-role'))
    @livewire('admin.pages.admins.partials.assign-role')
  @endif

  @if(admin()->can('administration-is-verify'))
    @livewire('admin.pages.admins.partials.verify')
  @endif

  @if(admin()->can('administration-read'))
    @livewire('admin.pages.admins.partials.show')
  @endif

  @if(admin()->can('administration-edit'))
    @livewire('admin.pages.admins.partials.edit')
  @endif

  @if(admin()->can('administration-delete'))
    @livewire('admin.pages.admins.partials.delete')
  @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


