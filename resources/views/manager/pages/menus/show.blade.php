@extends('manager.layouts.master')

@section('title', 'Menus')
@section('css')

@endsection
@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Show {{ $menu->name }}</h5>
            <a class="btn btn-sm btn-primary pt-1" href="{{ route('manager.menus.index') }}" >Back</a>
      
      </div>

      @if(manager()->can('menu-read'))
            @livewire('manager.pages.menus.get-show', ['menu' => $menu])
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
