@extends('layouts.cms.app')
@section('index', 'claimReward')
@section('title', 'Claim Reward')
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
              <h1>Redeem Reward</h1>
            </div>
            <div id="content_center">
              <div class="box-style1" style="margin-bottom:55px;">
                <div class="entry">
                  @guest
                    <p>Please login to continue.</p>
                  @else
                    <form class="send_prize">
                      <input type="hidden" name="id" value="{{$data['id']}}"/>
                      <input type="hidden" name="UserUID" value="{{$_SESSION['User']['UserUID']}}"/>
                      <p id="responseReward"></p>
                      @if($data['rewards']->checkIfRewardExists($data['id']))
                        @if($data['rewards']->getUserKills())
                          @if ($data['rewards']->getUserKills() >=$data['rewards']->Kills['K'.$data['id']])
                            @if(!count($data['rewards']->validateKills($data['id'])))
                              @if(!isset($_COOKIE['secureWeb']))
                                {{-- {{$data['rewards']->setRewardCookie()}} --}}
                                <div class="text-center">
                                  <h3 class="text-white">Prize: #{{$data['id']}}</h3>
                                  <h3 class="text-white">Reward: {{$data['rewards']->Rewards['K'.$data['id']]}}</h3>
                                  <button type="button" class="custom_button" id="send_prize_submit">
                                    Redeem <i class="fa fa-send"></i>
                                  </button>
                                  @Separator(20)
                                </div>
                              @else
                                You can only redeem one reward at a time.
                              @endif
                            @else
                              <td class="text-center">You already redeemed this Prize!</td>
                            @endif
                          @else
                            <td>You need more kills to redeem this Prize!</td>
                          @endif
                        @else
                          <td>You need more kills to redeem this Prize!</td>
                        @endif
                      @else
                        Reward ID Does not exist!
                      @endif
                    </form>
                  @endguest
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      @include('partials.cms.sidebar')
    </div>
    <script>
	$(document).ready(function(){
    $("#send_prize_submit").unbind().click(function(e) {
      e.preventDefault();

      if ( $(this).hasClass("unclickable") ) {
        e.preventDefault();
      } else {
        $(this).addClass("unclickable");
          $.ajax({
          type: "POST",
          url: "/resources/jquery/addons/ajax/site/pvpRewards/redeem.submit.php",
          dataType: "text",
          data: $("form.send_prize").serialize(),
          success: function(data) {
              $('#responseReward').html(data);
            },
          error: function(error) {
            console.log(error);
          }
        })
      }
    });
	});
</script>
    @include('layouts.cms.footer')
  </div>
@endsection
