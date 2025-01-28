@extends('supervisor.layouts.master')

@section('title', 'Reports')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between flex-wrap mb-2">
            <h4 class="fw-bolder fs-4">Reports [ Stocks Transactions ]</h4>
            <a href="{{ route('supervisor.reports.index') }}" class="btn btn-primary btn-round btn-sm d-block">
                  <span class="ion ion-md-arrow-back"></span> Back
            </a> 
      </div>
      @livewire('supervisor.pages.reports.stocks.transactions')


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
