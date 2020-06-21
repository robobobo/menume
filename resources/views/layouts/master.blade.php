<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title','Home') Menu Me</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
