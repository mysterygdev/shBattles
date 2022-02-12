@extends('layouts.cms.app')
@section('index', 'vote')
@section('title', 'Vote')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      {{-- <div class="info">
        <div>
          <div class="container">
            <h1>title</h1>
          </div>
        </div>
      </div> --}}
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Vote</h2>
        @guest
          <p>Please login to continue.</p>
        @else
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
        @endguest
    </div>
  </section>
  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
@endsection
