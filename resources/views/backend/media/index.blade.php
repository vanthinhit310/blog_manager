@extends('layouts.app', ['title' => __('Media Management')])
@push('css')
    <!-- Media manager -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/MediaManager/bulma.css') }}">
@endpush
@section('content')
    <div class="notif-container">
        <my-notification></my-notification>
    </div>

    <div class="container is-fluid">
        <div class="columns">
            {{-- media manager --}}
            <div class="column">
                @include('MediaManager::_manager')
            </div>
        </div>
    </div>
@stop
