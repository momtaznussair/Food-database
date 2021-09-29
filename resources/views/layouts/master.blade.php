<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Proof of concept for a food database">
		<meta name="Author" content="momtaz nussair">
		<meta name="Keywords" content="momtaz nussair food database filters prood of concept"/>
		@include('layouts.head')
	</head>

	<body class="main-body app sidebar-mini">
		<!-- Loader -->
		<div id="global-loader">
			<img src="{{URL::asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		</div>
		<!-- /Loader -->
		{{-- @include('layouts.main-sidebar')		 --}}
		<!-- main-content -->
		<div class="main-content app-content ml-0">
			@include('layouts.main-header')			
			<!-- container -->
			<div class="container-fluid">
				@yield('page-header')
				@yield('content')
				{{-- @include('layouts.sidebar') --}}
				@include('layouts.models')
            	@include('layouts.footer')
				@include('layouts.footer-scripts')	
	</body>
</html>