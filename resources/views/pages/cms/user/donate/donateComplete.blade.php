@extends('layouts.cms.app')
@section('index', 'donateComplete')
@section('title', 'Donate Complete')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Donate Complete
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">Donate Complete</span>
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
                @foreach ($data['donate']->getLastPayment() as $res)
                  <p>Thank you, <span class="fw_bold">{{$_SESSION['User']['UserID']}}</span> for your donation.</p>
                  <p>Your donation to <span class="fw_bold">{{APP['title']}}</span> has been completed.</p>
                  <p>Payment Amount: {{$res->Paid}}</p>
                  <p>Points Purchased: {{$res->Reward}}</p>
                  @if ($res->PaymentMethod == 'paypal')
                    <p>Transaction ID: {{$res->TransID}}</p>
                  @endif
                  @if(PAYPAL['conf_email'])
                    You will recieve a confirmation email shortly. Thank you for your donation.
                  @endif
                @endforeach
              @endguest
            </div>
        </div>
        @include('partials.cms.widgets')
      </div>
    </div>
  </section>
	@include('layouts.cms.footer')
@endsection
