@extends('layouts.cms.app')
@section('index', 'rules')
@section('title', 'Rules')
@section('zone', 'CMS')
@section('content')
  <div id="exception"></div>
  @include('partials.cms.nav')
  <div class="wrapper">
    @include('partials.cms.header')
    <div class="container">
      <main class="content">
        @include('partials.cms.slider')
        <div id="content">
          <div id="box1">
            <div class="title1">
              <h1>Rules</h1>
            </div>
            <div id="content_center">
              <div class="box-style1" style="margin-bottom:55px;">
                <h2 class="title">Create your account in just few clicks</h2>
                <div class="entry">
                  adsasd
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      @include('partials.cms.sidebar')
    </div>
    @include('layouts.cms.footer')
  </div>
@endsection
