@extends('layouts.cms.app')
@section('index', 'bossRecords')
@section('title', 'Boss Records')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      <div class="info">
        <div>
          <div class="container">
            <h1>title</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container youplay-content text-center">
      <h2 class="mt-0">Boss Records</h2>
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
            <tr class="boss-record">
              <th class="boss-record">Boss</th>
              <th class="boss-record">Killed by</th>
              <th class="boss-record">Respawns in</th>
            </tr>
          </thead>
          @php
            $time = date("Y-m-d H:i:s.000");
          @endphp
          @foreach($data['bossrecords']->MobID as $value)
            @php
              $data['bossrecords']->getBossRecords($time,$value);
            @endphp
          @endforeach
        </table>
      </div>
    </div>
  </section>

    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
@endsection
