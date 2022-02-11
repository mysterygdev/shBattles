@php header('HTTP/1.1 502 Bad Gateway'); @endphp
@extends('layouts.cms.app')
@section('index', '502')
@section('title', '502')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 502 : Bad Gateway</h3>
                    <p>The server was acting as a gateway or proxy and received an invalid response from the upstream server</p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.cms.footer')
@endsection
