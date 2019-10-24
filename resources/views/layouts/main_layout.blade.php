<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="{!! asset('css/app.css')  !!}">
	<title>@yield('title')</title>
</head>
<body>
	<div class="container">
		<!-- start of app-->
		<div id="app">@yield('app')</div>
		<!-- end of app-->

		<!-- start of content-->
		<div>@yield('content')</div>
		<!-- end of content-->
	</div>
	@yield('scripts')
	<script src="{!! asset('js/manifest.js') !!}"></script>
	<script src="{!! asset('js/vendor.js') !!}"></script>
	<script src="{!! asset('js/app.js') !!}"></script>
</body>
</html>