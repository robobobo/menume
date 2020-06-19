<html>
    <head>
        <title>@yield('title','Home') Menu Me</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" >
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
