@extends('layouts.cms.app')
@section('index', 'rewards')
@section('title', 'Rewards')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <div class="content-wrap">
    <div class="mpl-navbar-mobile-overlay"></div>
    <div>
      <div class="mpl-box-md">
        <br>
        {{display('get_reward_modal','','0','2','Redeem Reward')}}
        <div class="container">
          <div class="row hgap-lg vgap-lg">
            <div class="col mpl-content" data-sr="post" data-sr-duration="1000" data-sr-distance="20">
              <section class="">
                <div class="mpl-banner-content mpl-box-sm">
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                        <div class="mpl-sign-form" data-sr="sign" data-sr-interval="100" data-sr-duration="1000" data-sr-distance="20">
                          <h1 data-sr-item="sign">Rewards</h1>
                          @if (!$data['user']->LoginStatus==true)
                            <p>Please login to continue.</p>
                          @else
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
                                    $index=1;
                                  @endphp
                                  @foreach ($data['rewards']->Rewards as $Reward)
                                    <tr>
                                      <td>{{$index}}</td>
                                      <td>{{$data['rewards']->Kills['K'.$index]}}</td>
                                      <td><div class="RankIcon RankIcon{{$index}}"></div></td>
                                      <td>{{$Reward}}</td>
                                      @if ($data['rewards']->k1 >=$data['rewards']->Kills['K'.$index])
                                        @php
                                          $data['rewards']->validateKills($index);
                                        @endphp
                                        @if($data['rewards']->rowCount==0)
                                          <td class="text-center"><button class="btn gradient color-white open_send_prize_modal" data-toggle="modal" data-id="{{$index}}~{{$Reward}}~{{$_SESSION['User']['UserUID']}}" data-target="#get_reward_modal">Redeem Prize</button></td>
                                        @else
                                          <td class="tac">You already redeemed this Prize!</td>
                                        @endif
                                      @else
                                        <td>You need more kills to redeem this Prize!</td>
                                      @endif
                                    </tr>
                                    @php $index++; @endphp
                                  @endforeach
                                </tbody>
                              </table>
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            @include('partials.cms.widgets')
          </div>
        </div>
      </div>
    @include('layouts.cms.footer')
    </div>
  </div>
  @include('layouts.cms.scripts')
@endsection
