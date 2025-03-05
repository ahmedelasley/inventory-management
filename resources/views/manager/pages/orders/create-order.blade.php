@extends('manager.layouts.master')

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
            <div class="col-md-12">
 


            {{-- @if($order->type == 'Pending')
                  <x-text-show  class='bg-warning text-center text-white' :value='$order->type'/>
              @elseif($order->type == 'Send')
                  <x-text-show  class='bg-info text-center text-white' :value='$order->type'/>
              @elseif($order->type == 'Processed')
                  <x-text-show  class='bg-success text-center text-white' :value='$order->type'/>
              @elseif($order->type == 'Shipped')
                  <x-text-show  class='bg-dark text-center text-white' :value='$order->type'/>
              @elseif($order->type == 'Received')
                  <x-text-show  class='bg-primary text-center text-white' :value='$order->type'/>
              @endif --}}



            </div>

      </div>

      <div class="row justify-content-center">
            @if(manager()->can('transfer-read'))
                <div class="col-md-5">

                    @livewire('manager.pages.orders.partials.title', ['order' => $order])
                    @livewire('manager.pages.orders.partials.cart', ['order' => $order])
                </div>
                <div class="col-md-7">
                    @livewire('manager.pages.orders.partials.products' , ['order' => $order])
                </div>
            @endif
      </div>
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
