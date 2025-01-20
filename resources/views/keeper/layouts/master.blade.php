<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">
	<head>
		<meta charset="UTF-8">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		<title>
			@hasSection('title')
			{{ getSetting('name') }} | @yield('title')
			@else
			{{ getSetting('name') }}
			@endif
		</title>

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css" />
		@include('keeper.layouts.partials.head-styles')
		@livewireStyles
	</head>

	<body>

		<!-- Layout wrapper -->
		<div class="layout-wrapper layout-content-navbar">
			<div class="layout-container">
				@include('keeper.layouts.partials.sidebar')
				<!-- Layout container -->
				<div class="layout-page">
					@include('keeper.layouts.partials.navbar')

						<!-- Content wrapper -->
						<div class="content-wrapper">
						
							<div class="container-fluid flex-grow-1 container-p-y">
							@yield('content')
						</div>
						<!-- / Content -->
						@include('keeper.layouts.partials.footer')
					<div class="content-backdrop fade"></div>
				</div>
				<!-- Content wrapper -->
				</div>
				<!-- / Layout page -->
			</div>

			<!-- Overlay -->
			<div class="layout-overlay layout-menu-toggle"></div>
		</div>
		<!-- / Layout wrapper -->



		@include('keeper.layouts.partials.footer-scripts')

		@include('sweetalert::alert')

		@livewireScripts

		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<x-livewire-alert::scripts />

		
		{{-- Solve this problem page has expired --}}
		<script>
			document.addEventListener('livewire:init', () => {
				Livewire.hook('request', ({ fail }) => { 
					fail(({ status, preventDefault }) => {
						if (status === 419) {
							preventDefault()
							confirm('Your session has expired...')
							location.reload();
						}
					})
				})
			})
		</script>

		<script>


    // document.addEventListener('livewire:load', function () {
    //     const inputs = document.querySelectorAll('[data-role="tagsinput"]');
    //     inputs.forEach(input => {
    //         $(input).tagsinput();
    //     });
    // });


			window.addEventListener('close-modal', event => {
				$('#createModal').modal('toggle');
				// $('#editModal').modal('toggle');
			})

			// window.addEventListener('createModalToggle', event => {
			// 	$('#createModal').modal('toggle');
			// })
			window.addEventListener('showModalToggle', event => {
				$('#showModal').modal('toggle');
			})

			window.addEventListener('editModalToggle', event => {
				$('#editModal').modal('toggle');
			})
			window.addEventListener('deleteModalToggle', event => {
				$('#deleteModal').modal('toggle');
			})
			window.addEventListener('deleteSelectedModalToggle', event => {
				$('#deleteSelectedModal').modal('toggle');
			})
			window.addEventListener('importModalToggle', event => {
				$('#importModal').modal('toggle');
			})
			// window.addEventListener('importProductsModalToggle', event => {
			// 	$('#importProductsModal').modal('toggle');
			// })
			// window.addEventListener('close-modal', event => {
				
			// 	// CRUD Modal
			// 	$('#basicModal').modal('toggle');

			// 	$('#showModel').modal('hide');
			// 	$('#createModal').modal('hide');
			// 	$('#updateModal').modal('hide');
			// 	$('#deleteModal').modal('hide');

			// 	$('#showPhonesModal').modal('hide');
			// 	$('#phoneModal').modal('hide');
			// 	$('#deletePhoneModal').modal('hide');

			// 	$('#passwordModal').modal('hide');
			// 	$('#assignRoleModal').modal('hide');
			// 	$('#assignPermissionModal').modal('hide');

			// 	// $('#pictureModal').modal('hide');
			// 	// $('#viewPictureModal').modal('hide');
			// 	// $('#archiveModal').modal('hide');
			// 	// $('#softDeleteModal').modal('hide');
			// 	// $('#destroyModal').modal('hide');
			// })


		</script>

	</body>
</html>