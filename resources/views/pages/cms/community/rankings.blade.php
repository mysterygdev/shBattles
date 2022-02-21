@extends('layouts.cms.app')
@section('index', 'rankings')
@section('title', 'Rankings')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Rankings</h2>
        <div id="rankingsData"></div>
    </div>
  </section>

    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
@endsection
