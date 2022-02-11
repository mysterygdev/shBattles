@php header('HTTP/1.1 401 Unauthorized'); @endphp
@extends('layouts.cms.app')
@section('index', '401')
@section('title', '401')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="error-area">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="error-content">
                    <img src="/resources/themes/zelda/img/error.png" alt="image">
                    <h3>Error 401 : Unauthorized</h3>
                    <p>The request has not been applied because it lacks valid authentication credentials for the target resource.</p>
                    <a href="/" class="default-btn">Go to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('layouts.cms.footer')
@endsection
