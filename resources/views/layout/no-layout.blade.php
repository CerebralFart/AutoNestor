<html>
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>
        Auto-Nestor
        @hasSection('title') - @yield('title')@endif
    </title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@yield('body')
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
