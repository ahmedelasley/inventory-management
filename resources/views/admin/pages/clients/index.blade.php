@extends('admin.layouts.master')

@section('title', 'Clients')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Clients</h5>

            
            @if(admin()->can('client-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>

                  @livewire('admin.pages.clients.partials.create')
            @endif

      </div>

      @if(admin()->can('client-list'))
            @livewire('admin.pages.clients.get-data')
      @endif

      @if(admin()->can('client-edit'))
            @livewire('admin.pages.clients.partials.edit')
      @endif

      @if(admin()->can('client-delete'))
            @livewire('admin.pages.clients.partials.delete')
      @endif
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
