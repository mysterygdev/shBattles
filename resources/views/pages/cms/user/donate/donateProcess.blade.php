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
          @elseif (
              $data['donate']->getMethod() == 'crypto' && $data['donate']->getType() == 'normal'
              && !empty($data['donate']->getKey())
            )



    {{-- <div>
      <a class="buy-with-crypto"
        href="https://commerce.coinbase.com/checkout/837dc0e3-2517-4e27-a000-1fbe3fd73ecd">
        Buy 2000 DP
      </a>
      <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
      </script>
    </div> --}}

    <div>
      <a class="buy-with-crypto"
        href="https://commerce.coinbase.com/checkout/{{$data['donate']->getCryptoCheckout()}}">
        Donate
      </a>
      {{-- <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
      </script> --}}
      <script src="https://commerce.coinbase.com/v1/checkout.js?onload=onPaymentDetected"></script>
      <script>
        BuyWithCrypto.registerCallback('onPaymentDetected', function(e){
          // Charge failed
          alert("wtf");
      });
      </script>
    </div>

    {{-- <div>
      <a class="buy-with-crypto"
        href="https://commerce.coinbase.com/checkout/a5fd1510-6e05-437b-b0a3-69893b232695">
        Buy 1000 DP
      </a>
      <script src="https://commerce.coinbase.com/v1/checkout.js?version=201807">
      </script>
    </div> --}}


</div>

              @php
                /* $ch = curl_init("https://api.commerce.coinbase.com/charges/");
                 $post = array(
    "name" => "E currency exchange",
    "description" => "Exchange for Whatever",
    "local_price" => array(
        'amount' => '1.00',
        'currency' => 'USD'
    ),
    "pricing_type" => "fixed_price",
    "metadata" => array(
        'customer_id' => 'customerID',
        'name' => 'ANY NAME'
    )
);
$post = json_encode($post);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        // This is often required if the server is missing a global cert bundle, or is using an outdated one.
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $headers[] = "Content-Type: application/json";
        $headers[] = "X-Cc-Api-Key: 891d32f3-41c3-4e86-b4ac-ab00fd5b2e44";
        $headers[] = "X-Cc-Version: 2018-03-22";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $res = curl_exec($ch);
        var_dump($res);
        $info = curl_getinfo($ch);
        $http_code = $info['http_code'];
        curl_close($ch); */
              @endphp
          @elseif (empty($data['donate']->getMethod()) || empty($data['donate']->getKey()))
            An error has seemed to occur. Please try again.
          @endif
        @endguest
    </div>
  </section>

    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
@endsection
