@extends('layouts.cms.app')
@section('index', 'home')
@section('title', 'Home')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <section class="content-wrap">
    <!-- Banner -->
    <section class="youplay-banner banner-top youplay-banner-parallax">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-bg.jpg')">
      </div>

      <div class="info">
        <div>
          <div class="container">
            <h1>{{APP['title']}}</h1>
            <em>"quote here"</em>
            <br>
            <br>
            <br>
            <a class="btn btn-lg" href="/download">Download</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Show server data such as players online,servertime,etc -->
    @include('pages.cms.home.partials.data')
    @include('pages.cms.home.partials.info')
    {{-- @include('pages.cms.home.partials.popular') --}}
    {{-- @include('pages.cms.home.partials.preorder') --}}
    @include('pages.cms.home.partials.news')

    @include('layouts.cms.footer')

  {{-- @include('layouts.cms.footer') --}}
  @include('layouts.cms.scripts')
@endsection
