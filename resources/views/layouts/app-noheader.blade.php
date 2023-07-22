<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(!empty($dataPageDefault))
        @if(!empty($dataPageDefault->title))<title>{{ $dataPageDefault->title }}</title>@endif

        @if(!empty($dataPageDefault->description))<meta name="description" content="{{ $dataPageDefault->description }}">@endif

        @if(!empty($dataPageDefault->keywords))<meta name="keywords" content="{{ $dataPageDefault->keywords }}">@endif

    @else
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="keywords" content="">
        <meta name="description" content="">
@endif


    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <main class="auth-page-inner">
        <div class="auth-page-inner__logo">
            <a href="/"><img src="/images/logo_min.svg"/></a>
        </div>
        @yield('content')
    </main>
</div>
</body>
</html>
