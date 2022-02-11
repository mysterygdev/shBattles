@php header('HTTP/1.1 500 Internal Server Error'); @endphp
@extends('layouts.cms.app')
@section('index', '500')
@section('title', '500')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 500 : Internal Server Error</h3>
                    <p>The server encountered an unexpected condition that prevented it from fulfilling the request.</p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.cms.footer')
@endsection
