<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width initial-scale=1, maximum-scale = 1, user-scalable = no">
        <title>@yield('title', 'Playlister')</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container-fluid">
            @yield('content')
        </div>

        @include('layouts.partials.scripts')
        @yield('scripts')
    </body>
</html>