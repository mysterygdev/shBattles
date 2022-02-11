@php header('HTTP/1.1 405 Method Not Allowed'); @endphp
@extends('layouts.cms.app')
@section('index', '405')
@section('title', '405')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 405 : Method Not Allowed</h3>
                    <p>A request was made of a page using a request method not supported by that page</p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.cms.footer')
@endsection
