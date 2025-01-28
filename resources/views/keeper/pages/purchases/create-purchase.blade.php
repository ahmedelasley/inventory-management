@extends('keeper.layouts.master')

@section('title', 'Create Purchase')
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
      {{-- <h1>{{ $purchase }}</h1> --}}
      <div class="row">
            <div class="col-md-5">
                  @livewire('keeper.pages.purchases.partials.title', ['purchase' => $purchase])
                  @livewire('keeper.pages.purchases.partials.cart', ['purchase' => $purchase])
            </div>
            <div class="col-md-7">
                  @livewire('keeper.pages.purchases.partials.products' , ['purchase' => $purchase])
            </div>

      </div>
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
