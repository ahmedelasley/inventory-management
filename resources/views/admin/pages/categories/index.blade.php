@extends('admin.layouts.master')

@section('title', 'Categories')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Categories</h5>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                  Add
            </button>
            @livewire('admin.pages.categories.partials.create')
      
      </div>

      @livewire('admin.pages.categories.get-data')
      @livewire('admin.pages.categories.partials.edit')
      @livewire('admin.pages.categories.partials.delete')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
