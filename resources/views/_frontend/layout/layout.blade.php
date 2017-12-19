<!DOCTYPE html>
<html>
<head>
	<title>Front End Website</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
	{{-- <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet"> --}}
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
	<script type="text/javascript" src={{url('assets/frontend/vue/dist/vue.js')}}></script>
	<script type="text/javascript" src={{url('assets/frontend/vue/dist/vue.min.js')}}></script>
	{{-- <script type="text/javascript" src={{url('assets/frontend/vue/dist/vue.common.js')}}></script> --}}
	{{-- <script type="text/javascript" src={{url('assets/frontend/vue/dist/vue.runtime.js')}}></script> --}}
</head>
<body>
	<div id="app-content">
		@include('frontend.include.header')
		@yield('content')
		@include('frontend.include.footer')
	</div>
</body>
</html>
<script type="text/javascript" src="{{url('js/app.js')}}"></script>

