@php header('HTTP/1.1 400 Bad Request'); @endphp
@extends('layouts.cms.app')
@section('index', '400')
@section('title', '400')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 400 : Bad Request</h3>
                    <p>The request cannot be fulfilled due to bad syntax</p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.cms.footer')
@endsection
