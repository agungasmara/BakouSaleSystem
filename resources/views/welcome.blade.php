<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

        <title>Recipe Box</title>
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
        <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{mix('css/app.css')}}">
        <link rel="stylesheet" type="text/css" href="/css/stylus/main.styl">

    </head>

    <body>
        <div id="root">
        </div>
    </body>
    <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
    {{-- <script src="https://unpkg.com/vue/dist/vue.js"></script> --}}
    {{-- <script src="https://unpkg.com/vuetify/dist/vuetify.js"></script> --}}
    <script>
        new Vue({ el: '#root' })
    </script>
</html>
