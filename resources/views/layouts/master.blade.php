<html>
    <head>
        @if ($title)
                <title>{{ $title }}</title>
        @else
                <title>Example Laravel App</title>
        @endif
    </head>
    <body>
        <div><a href="/projects">Projects</a> | <a href="/tasks">Tasks</a>
        <hr/>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>