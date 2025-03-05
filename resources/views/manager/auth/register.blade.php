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

            <form id="formAuthentication" class="mb-3" action="{{ route('manager.register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <x-input-label for="name" class="form-label" :value="__('Name')" />
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                </div>

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


                <div class="mb-3">
                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                    <label class="form-check-label" for="terms-conditions"> I agree to <a href="javascript:void(0);">privacy policy & terms</a></label>
                    </div>
                </div>

                <button class="btn btn-primary d-grid w-100">Sign up</button>
            </form>
            <div class="mb-3">
                <p class="text-center">
                    <span>Already have an account?</span>
                    <a href="{{ route('manager.login') }}"><span>Sign in instead</span></a>
                </p>
            </div>
        </div>
    </div>
    <!-- Register Card -->
@endsection
