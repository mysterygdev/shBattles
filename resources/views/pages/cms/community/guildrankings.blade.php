@extends('layouts.cms.app')
@section('index', 'guildRankings')
@section('title', 'Guild Rankings')
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
      <h2 class="mt-0">Guild Rankings</h2>
      <table class="table table-responsive">
        <thead>
          <tr>
            <th>Rank</th>
            <th>Guild Name</th>
            <th>Guild Leader</th>
            <th>Members</th>
            <th>Points</th>
            <th>Faction</th>
          </tr>
        </thead>
        <tbody>
          @if (count($data['guildrankings']) > 0)
            @foreach ($data['guildrankings'] as $fet)
              <tr>
                <td>{{$fet->Rank}}</td>
                <td>{{$fet->GuildName}}</td>
                <td>{{$fet->MasterName}}</td>
                <td>{{$fet->TotalCount}}</td>
                <td>{{$fet->GuildPoint}}</td>
                @if ($fet->Country == 0)
                  <td><img src="/resources/themes/core/images/icons/guildranking/aol.png" height="35" width="35"></td>
                @else
                  <td><img src="/resources/themes/core/images/icons/guildranking/uof.png" height="35" width="35"></td>
                @endif
              </tr>
            @endforeach
          @else
            There are currently no guilds found.
          @endif
        </tbody>
      </table>
    </div>
  </section>

    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
@endsection
