@extends('admin.layouts.master')

@section('title', 'Keepers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
  <div class="d-flex justify-content-between  mb-2">
    <h5 class="fw-bolder fs-5">Keepers</h5>

    @if(admin()->can('keeper-create'))
      <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >Add</button>
      @livewire('admin.pages.keepers.partials.create')
    @endif

  </div>

  @if(admin()->can('keeper-list'))
    @livewire('admin.pages.keepers.get-data')
  @endif

  @if(admin()->can('keeper-assign-role'))
    @livewire('admin.pages.keepers.partials.assign-role')
  @endif

  @if(admin()->can('keeper-is-verify'))
    @livewire('admin.pages.keepers.partials.verify')
  @endif

  @if(admin()->can('keeper-read'))
    @livewire('admin.pages.keepers.partials.show')
  @endif

  @if(admin()->can('keeper-edit'))
    @livewire('admin.pages.keepers.partials.edit')
  @endif

  @if(admin()->can('keeper-delete'))
    @livewire('admin.pages.keepers.partials.delete')
  @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection


