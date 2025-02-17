@extends('admin.layouts.master')

@section('title', 'Menus')
@section('css')

@endsection
@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Show {{ $menu->name }}</h5>
            <a class="btn btn-sm btn-primary pt-1" href="{{ route('admin.menus.index') }}" >Back</a>
      
      </div>

      @if(admin()->can('menu-read'))
            @livewire('admin.pages.menus.get-show', ['menu' => $menu])
      @endif


</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
