@extends('keeper.layouts.master')

@section('title', 'Dashboard')
@section('css')

@section('content')
<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Profile</h4>

    <div class="row">
      <div class="col-md-4">
        @livewire('keeper.pages.profile.get-data')
      </div>

      <div class="col-md-8">
        <div class="card mb-4">
          {{-- <div class="d-flex justify-content-between "> --}}
            <h5 class="card-header">Permissions</h5>
          {{-- </div> --}}
          <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <div class="button-wrapper">
                  <h6 class="text-primary mb-0">
                    {{-- @if ($profile->roles->isNotEmpty())
                        @foreach ($profile->roles as $role)
                            <h6 class="text-primary">Role [ {{ $role->name }} ] Permissions:</h6>
                            @foreach ($role->permissions as $permission)
                                <span class="badge bg-success text-white m-1 p-2">
                                    {{ $permission->name }}
                                </span>
                            @endforeach
                        @endforeach
                    @endif --}}
                    @if ($profile->roles->isNotEmpty())
                        @foreach ($profile->roles->flatMap->permissions->unique('name') as $permission)
                            <span class="badge bg-success text-white m-1 p-2">
                                {{ $permission->name }}
                            </span>
                        @endforeach
                    @endif
                  </h6>
                </div>
            </div>
          </div>

        </div>
        @include('keeper.pages.profile.partials.update-password-form')

      </div>

    </div>
  </div>

  @livewire('keeper.pages.profile.partials.edit')

@endsection
@section('js')
