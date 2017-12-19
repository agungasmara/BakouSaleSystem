<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <title>Bakou Sale System</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
        <!-- Styles -->
        {{-- <link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}"> --}}
        <link href="/css/themes/horizontal-menu/materialize.css" type="text/css" rel="stylesheet">
        <link href="/css/themes/horizontal-menu/style.css" type="text/css" rel="stylesheet">
        <!-- Custome CSS-->
        <link href="/css/custom/custom.css" type="text/css" rel="stylesheet">
        <!-- CSS style Horizontal Nav-->
        <link href="/css/layouts/style-horizontal.css" type="text/css" rel="stylesheet">
        <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
        <link href="/vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
        <link href="/vendors/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet">
        <link href="/vendors/flag-icon/css/flag-icon.min.css" type="text/css" rel="stylesheet">
        {{-- <link rel="stylesheet" type="text/css" href="/css/materialize.css"> --}}
        {{-- <link rel="stylesheet" type="text/css" href="{{url('stylus/main.styl')}}"> --}}

    </head>

    <body>
        <div id="root">
            <!-- <router-view class="view"></router-view> -->
        </div>
    </body>
    <!-- <router-view></router-view> -->
    <script type="text/javascript" src="{{url('js/app.js')}}"></script>
    <script type="text/javascript" src="/vendors/jquery-3.2.1.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- chartjs -->
    <script type="text/javascript" src="/vendors/chartjs/chart.min.js"></script>
    <!-- sparkline -->
    <script type="text/javascript" src="/vendors/sparkline/jquery.sparkline.min.js"></script>
    <!-- google map api -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>
    <!--jvectormap-->
    <script type="text/javascript" src="/vendors/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="/vendors/jvectormap/vectormap-script.js"></script>
    <!--google map-->
    <script type="text/javascript" src="/js/scripts/google-map-script.js"></script>
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="/js/plugins.js"></script>
    <!--card-advanced.js - Page specific JS-->
    <script type="text/javascript" src="/js/scripts/dashboard-analytics.js"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="/js/custom-script.js"></script>
    {{-- <script src="https://unpkg.com/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>
    <script>
        new Vue({ el: '#root' })
    </script> --}}
</html>
