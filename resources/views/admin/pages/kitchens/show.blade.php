@extends('admin.layouts.master')

@section('title', $data->name)
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">{{ $data->name }} Stock</h5>
            <a href="{{ route('admin.kitchens.index') }}" class="btn btn-primary btn-round btn-sm d-block">
                  <span class="ion ion-md-arrow-back"></span> Back
            </a>      
      </div>
      
      @livewire('admin.pages.kitchens.show-data', ['id' => $data->id])

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
