<html>
    <head>
        @yield('styles')
        <title>Laravel 10</title>
    </head>

    <body>
        <h1>
            @yield('title')
        </h1>
        <div>
        @if(session()->has('success'))
            <p>{{session('success')}}</p>
        @endif
            @yield('content')
        </div>
    </body>
</html>