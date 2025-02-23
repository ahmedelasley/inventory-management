<!DOCTYPE html>
<html class="light-style layout-menu-fixed"  lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		<title>@yield('title')</title>


		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
		@include('admin.layouts.partials.head-styles')
    <link rel="stylesheet" href="{{ URL::asset('assets/admin') }}/css/errors.css" />

	</head>

	<body>

        <div class="container-fluid flex-grow-1 container-p-y">

            <!-- Error -->
            <div class="container-xxl container-p-y flex-grow-1 d-flex align-items-center justify-content-center text-center">

                <div class="misc-wrapper">
                    <div class="error">        
                        <div class="error-code">
                            <h1>
                                @php $code = trim(View::yieldContent('code')); @endphp
                                @foreach(str_split($code) as $char)
                                    <span>{{ $char }}</span>
                                @endforeach
                            </h1>
                        </div>
                    
                    
                        <h2 class="mb-2 mx-2">@yield('type')</h2>
                        {{-- <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p> --}}
                        <h4 class="mb-4 mx-2"> @yield('message')</h4>
            
                        <a href="javascript:history.back()" class="btn btn-primary">Back</a>
                        @if (Auth::guard('admin')->check())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Home</a>
                        @elseif (Auth::guard('manager')->check())
                            <a href="{{ route('manager.dashboard') }}" class="btn btn-primary">Home</a>
                        @elseif(Auth::guard('supervisor')->check())
                            <a href="{{ route('supervisor.dashboard') }}" class="btn btn-primary">Home</a>
                        @elseif(Auth::guard('keeper')->check())
                            <a href="{{ route('adkeepermin.dashboard') }}" class="btn btn-primary">Home</a>
                        @else
                        <a href="{{ url('/') }}" class="btn btn-primary">Home</a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /Error -->

        </div>

	</body>
</html>