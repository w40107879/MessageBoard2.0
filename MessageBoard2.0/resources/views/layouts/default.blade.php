<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    <script src="/js/manifest.js"></script>
    <script src="/js/vendor.js"></script>
    @yield('script')
</body>
</html>
