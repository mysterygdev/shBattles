@php header('HTTP/1.1 500 Internal Server Error'); @endphp
@extends('layouts.cms.app')
@section('index', '404')
@section('title', '404')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')
<section class="content-wrap full youplay-404">

    <!-- Banner -->
    <div class="youplay-banner banner-top">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/game-dark-souls-ii-10-1680x1050.jpg')">
      </div>

      <div class="info">
        <div>
          <div class="container align-center">
            <h2 class="h1">Error 500 : Internal Server Error</h2>
            <h3>The server encountered an unexpected condition that prevented it from fulfilling the request.</h3>
          </div>
        </div>
      </div>
    </div>
    <!-- /Banner -->

  </section>
@include('layouts.cms.footer')
@include('layouts.cms.scripts')
@endsection
