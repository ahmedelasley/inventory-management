@extends('supervisor.layouts.master')

@section('title', 'Kitchens')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Kitchens</h5>
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
