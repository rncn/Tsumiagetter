<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/library/uikit/uikit.min.css">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/library/uikit/uikit.min.js"></script>
    <script src="/library/uikit/uikit-icons.js"></script>
    <script src="/library/js/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('page-title') - {{ config('app.name') }}</title>
</head>
<body>
    @yield('body')
</body>
</html>