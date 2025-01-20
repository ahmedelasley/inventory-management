@extends('admin.layouts.guest')

@section('title', 'Forgot Password Page')

@section('content')
    <!-- Login Card -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                @include('admin.layouts.partials.logo')
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Forgot Password? 🔒</h4>
            <p class="mb-4">{{ __("Enter your email and we'll send you instructions to reset your password.") }}</p>
            <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
            <form id="formAuthentication" class="mb-3" action="{{ route('admin.password.email') }}" method="POST">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <x-input-label for="email" class="form-label" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"  autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <button class="btn btn-primary d-grid w-100">{{ __('Email Password Reset Link') }}</button>
            </form>
            <div class="mb-3">
                <p class="text-center">
                    <a href="{{ route('admin.login') }}"><i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i><span>Back to Login</span></a>
                </p>
            </div>

        </div>
    </div>
    <!-- Login Card -->
@endsection
