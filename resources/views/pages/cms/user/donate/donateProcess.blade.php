@extends('layouts.cms.app')
@section('index', 'donateProcess')
@section('title', 'Donate Process')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Donate Process
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">Donate Process</span>
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
                {{-- {{$data['donate']->getKey()}} --}}
                @if ($data['donate']->getMethod() == 'paypal')
                  <h2 class="text-center">Processing Your Donation...</h2>
                  We are now processing your donation. You will be re-directed to PayPal to complete the process.<br><br>
                  {{$data['donate']->getDonateInfo($data['donate']->getKey(), $data['donate']->getMethod())}}
                @elseif ($data['donate']->getMethod() == 'stripe')
                  <h2 class="text-center">Processing Your Donation...</h2>
                  We are now processing your donation. You will be re-directed to Stripe to complete the process.<br><br>
                  {{-- {{$data['donate']->getDonateInfo($data['donate']->getKey(), $data['donate']->getMethod())}} --}}
                  <form action="/stripePost?id={{$data['donate']->getKey()}}" method="POST">
                    <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="{{STRIPE['publishable_key']}}"
                      data-amount="2345"
                      data-name="{{$data['donate']->getReward($data['donate']->getKey()).' points'}}"
                      data-description="receive {{$data['donate']->getReward($data['donate']->getKey())}} donation points"
                      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
                      data-locale="auto">
                    </script>
                  </form>
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
