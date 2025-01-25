@extends('supervisor.layouts.master')

@section('title', 'Notifications')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h5 class="fw-bolder fs-5">Notifications</h5>
      </div>
      @livewire('supervisor.pages.notifications.get-data')

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
