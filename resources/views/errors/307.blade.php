@php header('HTTP/1.1 307 Temporary Redirect'); @endphp
@extends('layouts.cms.app')
@section('index', '307')
@section('title', '307')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 307 : Temporary Redirect</h3>
                    <p>The requested page has moved temporarily to a new URL</p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.cms.footer')
@endsection
