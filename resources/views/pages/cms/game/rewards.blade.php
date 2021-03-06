@extends('layouts.cms.app')
@section('index', 'rewards')
@section('title', 'Rewards')
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
      <h2 class="mt-0">Rewards</h2>
      @guest
        <p>Please login to continue.</p>
      @else
        {{display('get_reward_modal','','0','2','Redeem Reward')}}
        <div class="table-responsive">
          <table class="table table-dark text-center">
            <thead>
              <tr>
                <th>Prize ID</th>
                <th>Kills Required</th>
                <th>Icon</th>
                <th>Reward</th>
                <th>Redeem</th>
              </tr>
            </thead>
            <tbody>
              @php
                $data['rewards']->getPvPRewards();

              @endphp
              @foreach ($data['rewards']->getRewards() as $Reward)
                <tr>
                  <td>{{$Reward->RewardID}}</td>
                  <td>{{$data['rewards']->getKillsReq($Reward->RewardID)}}</td>
                  <td><div class="RankIcon RankIcon{{$Reward->RewardID}}"></div></td>
                  <td>{{$Reward->Points}} DP</td>
                  @if ($data['rewards']->k1 >=$data['rewards']->getKillsReq($Reward->RewardID))
                    @if(count($data['rewards']->validateKills($Reward->RewardID)) === 0)
                      <td class="text-center"><button class="btn gradient color-white open_send_prize_modal" data-toggle="modal" data-id="{{$Reward->RewardID}}~{{$Reward->Points}} DP~{{$_SESSION['User']['UserUID']}}" data-target="#get_reward_modal">Redeem Prize</button></td>
                    @else
                      <td class="text-center">You already redeemed this Prize!</td>
                    @endif
                  @else
                    <td>You need more kills to redeem this Prize!</td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endguest
    </div>
  </section>
  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
@endsection
