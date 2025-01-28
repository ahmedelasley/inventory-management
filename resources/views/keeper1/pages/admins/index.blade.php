@extends('admin.layouts.master')

@section('title', 'Admins')
@section('css')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <div class="flex justify-content-between  mb-4">
        <h3 class="fw-bolder fs-3">Admins</h3>
        @include('admin.pages.admins.partials.create-modal')
    </div>
    <div class="row">
      <div class="col-md-12">

        <!-- Striped Rows -->
        <div class="card ">
          <div class="card-body">
            @if (count($data) > 0)
              <div class="table-responsive text-wrap"  style="height : calc(100vh - 330px)">
                <table class="table table-striped table-hover table-sm text-center">
                  <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                    <tr>
                      <th class="fw-bolder fs-6">#</th>
                      <th class="fw-bolder fs-6">Name</th>
                      <th class="fw-bolder fs-6">Email</th>
                      <th class="fw-bolder fs-6">Verified At</th>
                      <th class="fw-bolder fs-6">Role</th>
                      <th class="fw-bolder fs-6">Created At</th>
                      <th class="fw-bolder fs-6">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                      @forelse ($data as $value)

                    <tr>
                      <td>{{$loop->iteration }}</td>
                      <td><strong>{{ $value->name }}</strong></td>
                      <td>{{ $value->email }}</td>
                      <td><span class="badge bg-label-primary me-1">{{ $value->email_verified_at ? 'Active' : '' }}</span></td>
                      <td>
                        @if (count($value->getRoleNames()) > 0)
                          <span class="badge bg-warning text-white p-2">
                            {{ $value->getRoleNames()[0] ?? '' }}
                          </span>
                        @endif
                      </td>
                      <td>{{ $value->created_at }}</td>
                      <td>
                        <div class="dropdown">
                          <button type="button" class="btn btn-primary btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            Actions <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="javascript:void(0);"
                              x-data=""
                              x-on:click.prevent="$dispatch('open-modal', 'edit-{{ $value->id }}')"
                              ><i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'assign-role-{{ $value->id }}')"
                              ><i class="bx bx-check me-1"></i> Assign Role
                            </a>
                            <a class="dropdown-item" href="javascript:void(0);"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'verify-{{ $value->id }}')"
                              ><i class="bx bx-envelope me-1"></i> Verify
                            </a>

                            <a class="dropdown-item" href="javascript:void(0);"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'delete-{{ $value->id }}')"
                              ><i class="bx bx-trash me-1"></i> Delete
                            </a>
                          </div>
                        </div>
                        @include('admin.pages.admins.partials.assign-role-modal')
                        @include('admin.pages.admins.partials.edit-modal')
                        @include('admin.pages.admins.partials.verify-modal')
                        @include('admin.pages.admins.partials.delete-modal')

                      </td>
                    </tr>
                    {{-- @dump($user) --}}
                    @empty
                    <p>No users</p>
                      @endforelse
                  </tbody>
                </table>
              </div>

            @else
              <div class="alert alert-primary" role="alert">
                No data to display! - Add new data
              </div>
            @endif
          </div>
        </div>
        <!--/ Striped Rows -->

      </div>
    </div>
  </div>



@endsection
@section('js')
@endsection
