@extends('manager.layouts.guest')

@section('title', 'Login Page')

@section('content')
    <!-- Login Card -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                @include('manager.layouts.partials.logo')
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Welcome Restaurant Manager! 👋</h4>
            <p class="mb-4">Please sign-in to your account and start the adventure</p>
            <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
            <form id="formAuthentication" class="mb-3" action="{{ route('manager.login') }}" method="POST">
                @csrf


                <div class="mb-3">
                    <x-input-label for="email" class="form-label" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>
                @if (Route::has('password.request'))
                    <div class="mb-3">
                        <a href="{{ route('manager.password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
                <div class="mb-3 form-password-toggle">
                    <x-input-label for="password" class="form-label" :value="__('Password')" />
                    <div class="input-group input-group-merge">
                        <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>

                <div class="mb-3">
                    <div class="form-check">
                    <input class="form-check-input"  name="remember" type="checkbox" id="remember_me" />
                    <label class="form-check-label" for="remember_me"> Remember Me </label>
                    </div>
                </div>
            
                <button class="btn btn-primary d-grid w-100">Sign in</button>
            </form>
            <div class="mb-3">
                <p class="text-center">
                    <span>New on our platform?</span>
                    <a href="{{ route('manager.register') }}"><span>Create an account</span></a>
                </p>
            </div>
        </div>
    </div>
    <!-- Login Card -->
@endsection
