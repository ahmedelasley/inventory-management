@extends('manager.layouts.master')

@section('title', 'Clients')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Clients</h5>

            
            @if(manager()->can('client-create'))
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>

                  @livewire('manager.pages.clients.partials.create')
            @endif

      </div>

      @if(manager()->can('client-list'))
            @livewire('manager.pages.clients.get-data')
      @endif

      @if(manager()->can('client-edit'))
            @livewire('manager.pages.clients.partials.edit')
      @endif

      @if(manager()->can('client-delete'))
            @livewire('manager.pages.clients.partials.delete')
      @endif
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
