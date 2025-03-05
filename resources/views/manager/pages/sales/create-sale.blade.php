@extends('manager.layouts.master')

@section('title', 'Create Sale')
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
      /* bsale-radius: 10%; */
      /* font-family: 'Lato', sans-serif; */
      text-decoration: none;	
      cursor:pointer;
  }
  .action-button:active
  {
    transform: translate(0px,5px);
    -webkit-transform: translate(0px,5px);
    bsale-bottom: 1px solid;
  }
  </style>
@endsection
@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 ">
      {{-- @dd($sale) --}}
      {{-- <h1>{{ $sale }}</h1> --}}

      <div class="row justify-content-center">
            <div class="col-md-12">
 


            {{-- @if($sale->type == 'Pending')
                  <x-text-show  class='bg-warning text-center text-white' :value='$sale->type'/>
              @elseif($sale->type == 'Send')
                  <x-text-show  class='bg-info text-center text-white' :value='$sale->type'/>
              @elseif($sale->type == 'Processed')
                  <x-text-show  class='bg-success text-center text-white' :value='$sale->type'/>
              @elseif($sale->type == 'Shipped')
                  <x-text-show  class='bg-dark text-center text-white' :value='$sale->type'/>
              @elseif($sale->type == 'Received')
                  <x-text-show  class='bg-primary text-center text-white' :value='$sale->type'/>
              @endif --}}



            </div>

      </div>

      <div class="row justify-content-center">
            <div class="col-md-5">
                  {{-- <div class="d-flex justify-content-between">
                        <h6 class="p-2 rounded-pill {{ $sale->type == 'Pending' ? 'bg-warning text-center text-white' : '' }}" ><img src="{{ URL::asset('assets/manager') }}/img/icons/unicons/pending.png" alt="User" style="width: 20px; height: 20px;"/></h6>
                        <h6 class="p-2 rounded-pill {{ $sale->type == 'Send' ? 'bg-info text-center text-white' : '' }}" >Send</h6>
                        <h6 class="p-2 rounded-pill {{ $sale->type == 'Processed' ? 'bg-success text-center text-white' : '' }}" >Processed</h6>
                        <h6 class="p-2 rounded-pill {{ $sale->type == 'Shipped' ? 'bg-dark text-center text-white' : '' }}" >Shipped</h6>
                        <h6 class="p-2 rounded-pill {{ $sale->type == 'Received' ? 'bg-primary text-center text-white' : '' }}" >Received</h6>
                  </div> --}}
                  @livewire('manager.pages.sales.partials.title', ['sale' => $sale])
                  @livewire('manager.pages.sales.partials.cart', ['sale' => $sale])
            </div>
            <div class="col-md-7">
                  @livewire('manager.pages.sales.partials.products' , ['sale' => $sale])
            </div>

      </div>
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
