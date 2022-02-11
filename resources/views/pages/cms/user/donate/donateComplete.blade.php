@extends('layouts.cms.app')
@section('index', 'donateComplete')
@section('title', 'Donate Complete')
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
        <h2 class="mt-0">Donate</h2>
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
  </section>

    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
@endsection
