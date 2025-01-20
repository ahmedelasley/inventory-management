@extends('user.layouts.guest')

@section('title', 'Login Page')

@section('content')
    <!-- Login Card -->
    <div class="card">
        <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center">
                @include('user.layouts.partials.logo')
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Verification Email! 👋</h4>
            <p class="mb-4">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-success">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
            <x-auth-session-status class="mb-4 text-success" :status="session('status')" />
            <form id="formAuthentication" class="mb-3" action="{{ route('verification.send') }}" method="POST">
                @csrf

            
                <button class="btn btn-primary d-grid w-100">{{ __('Resend Verification Email') }}</button>
            </form>
            <div class="mb-3">
                <p class="text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="btn btn-outline-danger w-100" href="{{route('logout')}}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">{{ __('Log Out') }}</span>
                        </a>
                      </form>


                    {{-- <a href="{{ route('logout') }}"><span>{{ __('Log Out') }}</span></a> --}}
                </p>
            </div>
        </div>
    </div>
    <!-- Login Card -->
@endsection
