@extends('layouts.cms.app')
@section('index', 'vote')
@section('title', 'Vote')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Vote
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">Vote</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
          <div class="title-bl text-center wow fadeIn" data-wow-duration="2s">
            <div class="title color-white">
              Vote for DP
            </div>
          </div>
            <div class="text-center">
              <p>You will receive {{VOTE['Point']}}  DP per vote.</p>
              <p>You can vote every 12 hours.</p>
              <form name="Vote" method="post" id="Vote" target="_new">
                <input type="radio" name="site" value="nr1" checked> XtremeTop100<br>
                <input type="radio" name="site" value="nr2"> OxigenTop100<br>
                <input type="radio" name="site" value="nr3"> GamingTop100<br>
                <input type="radio" name="site" value="nr4"> Top of Games<br/>
                @php Separator(20); @endphp
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/votenew.jpg" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/button_1.gif.png" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/vote.gif" alt="Shaiya Servers">
                <img style="margin-left:10px;" src="/resources/themes/core/images/Vote/47879_original.gif" alt="Shaiya Servers">
                @php Separator(40); @endphp
                <button type="submit" class="btn gradient color-white" id="Button1" name="Vote">Vote</button>
              </form>
            </div>
        </div>
        @include('partials.cms.widgets')
      </div>
    </div>
  </section>
	@include('layouts.cms.footer')
@endsection
