<!DOCTYPE html>
<html>
<head>
	<title>Front End Website</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
	<link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
	<div id="app-content">
		@include('frontend.include.header')
		@yield('content')
		@include('frontend.include.footer')
	</div>
</body>
</html>

<script src="https://unpkg.com/vue/dist/vue.js"></script>
<script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>

<script>
	new Vue({ el: '#app-content' })
</script>