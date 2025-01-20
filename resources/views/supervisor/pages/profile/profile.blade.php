@extends('admin.layouts.master')

@section('title', 'Dashboard')
@section('css')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

    <div class="row">
      <div class="col-md-12">

        <div class="card mb-4">
          <h5 class="card-header">Profile Details</h5>
          <!-- Account -->
          @include('admin.pages.profile.partials.update-photo-profile-information-form')

          <hr class="my-0" />
          @include('admin.pages.profile.partials.update-profile-information-form')

          <!-- /Account -->
        </div>

        @include('admin.pages.profile.partials.update-password-form')
        @include('admin.pages.profile.partials.delete-user-form')



      </div>
    </div>
  </div>
@endsection
@section('js')
