<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>@yield('title')</title>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/js.js') }}"></script>
        <script src="{{ asset('js/bootstrap3-wysihtml5.all.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap3-wysihtml5.min.js') }}"></script>
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap3-wysihtml5.min.css') }}">
        <link href="{{ asset('css/admin-style.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class='content'>
            @yield('content')
        </div>
    </body>
</html>