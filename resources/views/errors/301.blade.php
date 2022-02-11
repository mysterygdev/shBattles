@php header('HTTP/1.1 301 Moved Permanently'); @endphp
@extends('layouts.cms.app')
@section('index', '301')
@section('title', '301')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 301 : Moved Permanently</h3>
                    <p>The URL of the requested resource has been changed permanently. </p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.cms.footer')
@endsection
