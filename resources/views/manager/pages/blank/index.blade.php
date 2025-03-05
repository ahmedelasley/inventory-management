@extends('manager.layouts.master')

@section('title', 'Blank')
@section('css')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="flex justify-content-between  mb-4">
      <h3 class="fw-bolder fs-3">Blank</h3>
      {{-- @include('manager.pages.users.partials.create-modal') --}}
    </div>
    <div class="row">
      <div class="col-md-12">

        <!-- Striped Rows -->
        <div class="card ">
          <div class="card-body">
              <div class="table-responsive text-wrap"  style="height : calc(100vh - 330px)">
                <table class="table table-striped table-hover table-sm text-center">
                  <thead class="bg-white border-0 sticky-top" style="z-index: 9;">
                    <tr>
                      <th class="fw-bolder fs-6">#</th>
                      <th class="fw-bolder fs-6">Name</th>
                      <th class="fw-bolder fs-6">Email</th>
                      <th class="fw-bolder fs-6">Verified At</th>
                      <th class="fw-bolder fs-6">Created At</th>
                      <th class="fw-bolder fs-6">Actions</th>
                    </tr>
                  </thead>

                </table>
              </div>
          </div>
        </div>
        <!--/ Striped Rows -->
      </div>
    </div>
  </div>



@endsection
@section('js')
@endsection
