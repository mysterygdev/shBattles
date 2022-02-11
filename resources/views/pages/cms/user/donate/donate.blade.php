@extends('layouts.cms.app')
@section('index', 'donate')
@section('title', 'Donate')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Donate
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">Donate</span>
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
              Donate
            </div>
          </div>
            <div class="text-center">
              @guest
              <p>Please login to continue.</p>
              @else
              @if(isset($_POST["SubmitBtn"]) || isset($_POST["SubmitBtn"]) && !empty($_POST["SubmitBtn"]) || !empty($_POST["SubmitBtn"]))
                {{-- paypal post exist --}}
                {{$data['donate']->getHeader()}}
              @else
                @if(count($data['donate']->getOptions()) > 0)
                  <form style="display:inline;" action="" method="post">
                    <div class="table-responsive">
                      <table class="table table-dark text-center">
                        <thead>
                          <tr>
                            <th><input type="radio" name="RewardID" disabled="disabled" /></th>
                            <th>Reward</th>
                            <th>Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($data['donate']->getOptions() as $res)
                          <tr>
                            <td><input type="radio" name="RewardID" value="{{$res->RowID}}"></td>
                            <td>{{$res->Reward}} points</td>
                            <td>{{$res->Price}} {{DONATE['currency']}}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="separator_30"></div>
                    <br>
                    <div class="col-md-12 tac">
                      <div class="donate-btns">
                        <button type="submit" name="SubmitBtn" class="btn gradient color-white" value="paypal">
                          Donate with Paypal
                        </button>
                      </div>
                    </div>
                  </form>
                @else
                  Sorry. At the moment there are no donation options. Please come back later.
                @endif
              @endif
              @endguest
            </div>
        </div>
        @include('partials.cms.widgets')
      </div>
    </div>
  </section>
	@include('layouts.cms.footer')
@endsection
