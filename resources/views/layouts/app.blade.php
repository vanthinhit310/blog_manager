<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{@$title .' - '. config('app.name', 'Argon Dashboard') }}</title>
    <!-- Favicon -->
    <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Page plugins -->
    <link rel="stylesheet" href="{{asset('argon')}}/vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="{{asset('argon')}}/vendor/sweetalert2/dist/sweetalert2.min.css">

    @stack('css')

    <!-- Argon CSS -->
    <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.1.0" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/common.css') }}" rel="stylesheet">


</head>
<body class="{{ $class ?? '' }}">
<section id="app" v-cloak>
    @auth()
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
        @include('layouts.navbars.sidebar')
    @endauth

    <div class="main-content">
        @auth
            @include('layouts.navbars.navbar')
        @endauth
        @yield('content')
    </div>

    @guest()
        @include('layouts.footers.guest')
    @endguest
</section>

<!-- Vuejs -->
<script src="{{ asset("js/app.js") }}"></script>
{{--<script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>--}}
<script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('argon') }}/vendor/js-cookie/js.cookie.js"></script>
<script src="{{ asset('argon') }}/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="{{ asset('argon') }}/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
<script src="{{ asset('argon') }}/vendor/sweetalert2/dist/sweetalert2.min.js"></script>
<script src="{{ asset('argon') }}/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>

@stack('js')
@stack('styles')
@stack('scripts')

<!-- Argon JS -->
<script src="{{ asset('argon') }}/js/argon.js?v=1.1.0"></script>
<script src="{{ asset('argon') }}/js/alert.js?v=1.1.0"></script>
<script src="{{ asset('js/common.js?v=1.1.0') }}"></script>
@include('layouts.alert')
</body>
</html>
