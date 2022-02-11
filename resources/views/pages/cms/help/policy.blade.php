@extends('layouts.cms.app')
@section('index', 'privacy')
@section('title', 'Privacy')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  @include('partials.cms.pageHeader')
  <section class="blog-area ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="row">
            terms
          </div>
        </div>
        @include('partials.cms.widgets')
      </div>
    </div>
  </section>
  @include('layouts.cms.footer')
@endsection
