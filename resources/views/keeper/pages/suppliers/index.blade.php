@extends('keeper.layouts.master')

@section('title', 'Suppliers')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Suppliers</h5>
      </div>

      {{-- @if(keeper()->can('supplier-list')) --}}
            @livewire('keeper.pages.suppliers.get-data')
      {{-- @endif --}}

      {{-- @if(keeper()->can('supplier-read')) --}}
            @livewire('keeper.pages.suppliers.partials.show')
      {{-- @endif --}}

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
