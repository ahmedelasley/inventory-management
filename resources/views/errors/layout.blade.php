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
            @yield('message')
        </div>


	</body>
</html>


{{-- <!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>@yield('title')</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:900" rel="stylesheet">
<style>
	* {
    -webkit-box-sizing: border-box;
            box-sizing: border-box;
  }
  
  body {
    padding: 0;
    margin: 0;
  }
  
  #notfound {
    position: relative;
    height: 100vh;
  }
  
  #notfound .notfound {
    position: absolute;
    left: 50%;
    top: 20%;
    -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
  }
  
  .notfound {
    max-width: 520px;
    width: 100%;
    line-height: 1.4;
    text-align: center;
  }
  
  .notfound .notfound-404 {
    position: relative;
    height: 240px;
  }
  
  .notfound .notfound-404 h1 {
    font-family: 'Montserrat', sans-serif;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
    font-size: 252px;
    font-weight: 900;
    margin-bottom: 250px;
    color: #262626;
    text-transform: uppercase;
    letter-spacing: -40px;
    margin-left: -20px;
  }
  
  .notfound .notfound-404 h1>span {
    text-shadow: -8px 0px 0px #fff;
  }
  
  .notfound .notfound-404 h3 {
    font-family: 'Cabin', sans-serif;
    position: relative;
    font-size: 16px;
    font-weight: 700;
    text-transform: uppercase;
    color: #262626;
    margin: 0px;
    letter-spacing: 3px;
    padding-left: 6px;
  }
  
  /* .notfound h2 {
    font-family: 'Cabin', sans-serif;
    font-size: 20px;
    font-weight: 400;
    text-transform: uppercase;
    color: #000;
    margin-top: 0px;
    margin-bottom: 25px;
  } */
  
  @media only screen and (max-width: 767px) {
    .notfound .notfound-404 {
      height: 200px;
    }
    .notfound .notfound-404 h1 {
      font-size: 200px;
    }
  }
  
  @media only screen and (max-width: 480px) {
    .notfound .notfound-404 {
      height: 162px;
    }
    .notfound .notfound-404 h1 {
      font-size: 162px;
      height: 150px;
      line-height: 162px;
    }
    .notfound h2 {
      font-size: 16px;
    }
  }
</style>
	<!-- Custom stlylesheet -->
	@include('admin.layouts.partials.head-styles')

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

<meta name="robots" content="noindex, follow">
</head>

<body>

	@yield('message')


</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html> --}}