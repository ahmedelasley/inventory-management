@extends('admin.layouts.master')

@section('title', $data->product->name)
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">{{ $data->warehouse->name }} [ {{ $data->product->name }} ] Transactions</h5>
            <a href="{{ route('admin.warehouses.show', $data->warehouse->id) }}" class="btn btn-primary btn-round btn-sm d-block">
                  <span class="ion ion-md-arrow-back"></span> Back
            </a>     
      </div>
      
      @livewire('admin.pages.warehouses.show-transaction-data', ['id' => $data->id])

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
