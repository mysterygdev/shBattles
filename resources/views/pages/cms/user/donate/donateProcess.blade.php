@extends('layouts.cms.app')
@section('index', 'donateProcess')
@section('title', 'Donate Process')
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
          @if ($data['donate']->getMethod() == 'paypal' && $data['donate']->getType() == 'normal')
            <h2 class="text-center">Processing Your Donation...</h2>
            We are now processing your donation. You will be re-directed to PayPal to complete the process.<br><br>
            {{$data['donate']->getDonateInfo($data['donate']->getKey(), $data['donate']->getMethod())}}
          @elseif (
              $data['donate']->getMethod() == 'paypal' && $data['donate']->getType() == 'toFriend'
              && !empty($data['donate']->getKey())
            )
            <div class="row">
              <div class="col-md-3">
                <div class="youplay-input">
                  <input type="text" name="char" id="char" placeholder="Character Name">
                </div>
              </div>
            </div>
              <div class="donate-btns">
                <button type="submit" name="SubmitBtn" class="btn gradient color-white" value="paypal">
                  Send Payment
                </button>
              </div>
          @elseif (empty($data['donate']->getMethod()) || empty($data['donate']->getKey()))
            An error has seemed to occur. Please try again.
          @endif
        @endguest
    </div>
  </section>

    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
@endsection
