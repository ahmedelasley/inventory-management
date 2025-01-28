@extends('supervisor.layouts.master')

@section('title', 'Reports')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h4 class="fw-bolder fs-4">Reports</h4> 
      </div>

      <div class="row">

            <div class="col-lg-3 col-md-3 col-sm-6 my-5">
                  <a class="btn btn-primary btn-xl p-5 w-100" href="{{ route('supervisor.reports.stocks') }}">Stocks</a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 my-5">
                  <a class="btn btn-primary btn-xl p-5 w-100" href="{{ route('supervisor.reports.stocks.transactions') }}">Stocks Transactions</a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 my-5">
                  <a class="btn btn-primary btn-xl p-5 w-100" href="{{ route('supervisor.reports.orders') }}">Orders</a>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 my-5">
                  <a class="btn btn-primary btn-xl p-5 w-100" href="{{ route('supervisor.reports.orders.transactions') }}">Orders Transactions</a>
            </div>

      </div>

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
