@php $version = time(); @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="icon" href="" type="image/png" sizes="128x128">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/common.css?version='.$version) }}">
    <link rel="stylesheet" href="{{ asset('css/app.css?version='.$version) }}">
    <title>
        @hasSection('pageTitle')
            @yield('pageTitle')
        @else
            Page
        @endif
    </title>

    <!-- Fonts -->

    <!-- Styles -->
    @stack('style')
</head>
<body class="@hasSection('bodyClass'){{$bodyClass}}@endif">
    <div id="app">
        @yield('content')
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/common.js?version='.$version) }}"></script>
    <script src="{{ asset('js/app.js?version='.$version) }}"></script>
    @stack('script')
</body>
</html>
