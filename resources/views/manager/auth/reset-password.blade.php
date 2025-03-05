@extends('manager.layouts.guest')

@section('title', 'Register Page')

@section('content')
    <!-- Register Card -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                @include('manager.layouts.partials.logo')
            </div>
            <!-- /Logo -->

            <h4 class="mb-2">Adventure starts here 🚀</h4>
            <p class="mb-4">Make your app management easy and fun!</p>

            <form id="formAuthentication" class="mb-3" action="{{ route('manager.password.store') }}" method="POST">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-3">
                    <x-input-label for="email" class="form-label" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <div class="mb-3 form-password-toggle">
                    <x-input-label for="password" class="form-label" :value="__('Password')" />
                    <div class="input-group input-group-merge">
                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <div class="mb-3 form-password-toggle">
                    <x-input-label for="password_confirmation" class="form-label" :value="__('Confirm Password')" />
                    <div class="input-group input-group-merge">
                        <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                </div>

                <button class="btn btn-primary d-grid w-100">{{ __('Reset Password') }}</button>
            </form>
        </div>
    </div>
    <!-- Register Card -->
@endsection
