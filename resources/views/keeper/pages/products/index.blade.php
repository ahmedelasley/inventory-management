@extends('keeper.layouts.master')

@section('title', 'Products')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Products</h5>
      </div>

      {{-- @if(keeper()->can('product-list')) --}}
            @livewire('keeper.pages.products.get-data')
      {{-- @endif --}}

      {{-- @if(keeper()->can('product-read')) --}}
            @livewire('keeper.pages.products.partials.show')
      {{-- @endif --}}

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
