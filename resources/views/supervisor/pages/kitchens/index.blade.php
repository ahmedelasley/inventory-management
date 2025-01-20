@extends('supervisor.layouts.master')

@section('title', 'Kitchens')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Kitchens</h5>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                  Add
            </button>
            @livewire('supervisor.pages.kitchens.partials.create')
      
      </div>

      @livewire('supervisor.pages.kitchens.get-data')
      @livewire('supervisor.pages.kitchens.partials.show')
      @livewire('supervisor.pages.kitchens.partials.edit')
      @livewire('supervisor.pages.kitchens.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
