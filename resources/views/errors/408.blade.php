@php header('HTTP/1.1 408 Request Time-out'); @endphp
@extends('layouts.cms.app')
@section('index', '408')
@section('title', '408')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 408 : Request Timeout</h3>
                    <p>The server timed out waiting for the request</p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.cms.footer')
@endsection
