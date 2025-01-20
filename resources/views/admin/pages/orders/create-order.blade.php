@extends('admin.layouts.master')

@section('title', 'Create Order')
@section('css')
<style>
      		.my-custom-scrollbar {
			position: relative;
			height: 500px;
			overflow: auto;
		}
		.table-wrapper-scroll-y {
			display: block;
		}
		.backgroundEffect:hover {
			/* color: #fff; */
			transform: scale(1.025);
			box-shadow: rgba(0, 0, 0, 0.24) 0px 5px 10px
		}
		

      .action-button
  {
      position: relative;
      width: 100%;
      margin: 10px;
      padding: 0px;
      float: left;
      /* border-radius: 10%; */
      /* font-family: 'Lato', sans-serif; */
      text-decoration: none;	
      cursor:pointer;
  }
  .action-button:active
  {
      transform: translate(0px,5px);
  -webkit-transform: translate(0px,5px);
      border-bottom: 1px solid;
  }
  </style>
@endsection
@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 ">
      {{-- @dd($order) --}}
      {{-- <h1>{{ $order }}</h1> --}}
      <div class="row justify-content-center">
            <div class="col-md-5">
                  @livewire('admin.pages.orders.partials.title', ['order' => $order])
                  @livewire('admin.pages.orders.partials.cart', ['order' => $order])
            </div>
            <div class="col-md-7">
                  @livewire('admin.pages.orders.partials.products' , ['order' => $order])
            </div>

      </div>
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
