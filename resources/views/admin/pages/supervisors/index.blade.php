@extends('admin.layouts.master')

@section('title', 'Supervisors')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Supervisors</h5>

    @if(admin()->can('supervisor-create'))
      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
      @livewire('admin.pages.supervisors.partials.create')
    @endif

  </div>

  @if(admin()->can('supervisor-list'))
    @livewire('admin.pages.supervisors.get-data')
  @endif

  @if(admin()->can('supervisor-assign-role'))
    @livewire('admin.pages.supervisors.partials.assign-role')
  @endif

  @if(admin()->can('supervisor-is-verify'))
    @livewire('admin.pages.supervisors.partials.verify')
  @endif

  @if(admin()->can('supervisor-read'))
    @livewire('admin.pages.supervisors.partials.show')
  @endif

  @if(admin()->can('supervisor-edit'))
    @livewire('admin.pages.supervisors.partials.edit')
  @endif

  @if(admin()->can('supervisor-delete'))
    @livewire('admin.pages.supervisors.partials.delete')
  @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
