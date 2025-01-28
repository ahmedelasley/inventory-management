@extends('keeper.layouts.master')

@section('title', 'Warehouse')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">{{ Auth::guard('keeper')->user()->warehouse->name }}</h5>
      </div>

      @livewire('keeper.pages.inventory.get-data')
      @livewire('keeper.pages.inventory.partials.show')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
