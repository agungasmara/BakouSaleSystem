<!DOCTYPE html>
<html>
<head>
	<title>Front End Website</title>
	<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('assets/frontend/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('assets/frontend/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{url('assets/frontend/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{url('ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="assets/frontend/ico/favicon.png')}}">
    <title>TSHOP - Bootstrap E-Commerce Parallax Theme</title>
    
    @include('frontend.include.style')

    <!-- Just for debugging purposes. -->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="app-content">
		@yield('content')
	</div>

</body>
</html>

<script type="text/javascript" src="{{url('js/app.js')}}"></script>
@include('frontend.include.script')