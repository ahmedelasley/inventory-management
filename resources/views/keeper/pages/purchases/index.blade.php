@extends('keeper.layouts.master')

@section('title', 'Purchases')
@section('css')
@endsection
@section('content')
{{-- @dd($purchase->id) --}}
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Purchases</h5>
            <div>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('keeper.pages.purchases.partials.create')
      
                  {{-- <a href="{{ route('keeper.purchases.create.purchase') }}" class="btn btn-sm btn-primary"  >
                        Create
                  </a> --}}
            </div>

      
      </div>

      @livewire('keeper.pages.purchases.get-data')
      {{-- @livewire('keeper.pages.purchases.partials.delete') --}}

      {{-- @livewire('keeper.pages.purchases.partials.save')
      @livewire('keeper.pages.purchases.partials.edit') --}}
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
