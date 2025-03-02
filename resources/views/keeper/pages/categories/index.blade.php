@extends('keeper.layouts.master')

@section('title', 'Categories')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Categories</h5>
      </div>

      {{-- @if(keeper()->can('category-list')) --}}
            @livewire('keeper.pages.categories.get-data')
      {{-- @endif --}}

      {{-- @if(keeper()->can('category-read')) --}}
            @livewire('keeper.pages.categories.partials.show')
      {{-- @endif --}}

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
