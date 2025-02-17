@extends('admin.layouts.master')

@section('title', 'Managers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Managers</h5>

    @if(admin()->can('manager-create'))
      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
      @livewire('admin.pages.managers.partials.create')
    @endif

  </div>

  @if(admin()->can('manager-list'))
    @livewire('admin.pages.managers.get-data')
  @endif

  @if(admin()->can('manager-assign-role'))
    @livewire('admin.pages.managers.partials.assign-role')
  @endif

  @if(admin()->can('manager-is-verify'))
    @livewire('admin.pages.managers.partials.verify')
  @endif

  @if(admin()->can('manager-read'))
    @livewire('admin.pages.managers.partials.show')
  @endif

  @if(admin()->can('manager-edit'))
    @livewire('admin.pages.managers.partials.edit')
  @endif

  @if(admin()->can('manager-delete'))
    @livewire('admin.pages.managers.partials.delete')
  @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


