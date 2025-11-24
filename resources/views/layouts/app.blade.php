<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>@yield('title', 'Dashboard') - Kelompok 5</title>

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">

	<!-- Core CSS -->
	<link rel="stylesheet" href="{{ asset('assets/vendors/core/core.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/flatpickr/flatpickr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/fonts/feather-font/css/iconfont.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
	<link id="theme-stylesheet" rel="stylesheet" href="{{ asset('assets/css/demo1/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/theme-switcher.css') }}">
	<link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>

<div class="main-wrapper">

	@include('partials._sidebar')
	@include('partials._settings-sidebar')

	<div class="page-wrapper">
		@include('partials._navbar')

		<div class="page-content">
			@yield('content')
		</div>

		@include('partials._footer')
	</div>

</div>


<!-- Core JS -->
<script src="{{ asset('assets/vendors/core/core.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>

<!-- Template JS -->
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>

<!-- Custom -->
<script src="{{ asset('assets/js/dashboard-light.js') }}"></script>
<script src="{{ asset('assets/js/theme-switcher.js') }}"></script>
<script src="{{ asset('assets/js/settings-test.js') }}"></script>
<script src="{{ asset('assets/js/sidebar-fix.js') }}"></script>


<!-- jQuery WAJIB (dipanggil SETELAH CORE) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 CSS & JS (WAJIB DI BAWAH) -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('scripts')

</body>
</html>
