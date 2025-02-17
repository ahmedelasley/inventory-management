@extends('admin.layouts.master')

@section('title', 'Purchases')
@section('css')
@endsection
@section('content')
{{-- @dd($purchase->id) --}}
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Purchases</h5>

            @if(admin()->can('purchasing-create'))
            <div>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#createModal" >
                        Add
                  </button>
                  @livewire('admin.pages.purchases.partials.create')
            </div>
            @endif

      
      </div>

      @if(admin()->can('purchasing-list'))
            @livewire('admin.pages.purchases.get-data')
      @endif

      {{-- @livewire('admin.pages.purchases.partials.delete') --}}

      {{-- @livewire('admin.pages.purchases.partials.save')
      @livewire('admin.pages.purchases.partials.edit') --}}
  
</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
