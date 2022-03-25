@extends('layouts.cms.app')
@section('index', 'home')
@section('title', 'Home')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <section class="content-wrap">
    <!-- Banner -->
    <section class="youplay-banner banner-top youplay-banner-parallax">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-bg.jpg')">
      </div>

      <div class="info">
        <div>
          <div class="container">
            <h1>{{APP['title']}}</h1>
            <em>"quote here"</em>
            <br>
            <br>
            <br>
            <a class="btn btn-lg" href="/download">Download</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Show server data such as players online,servertime,etc -->
    <div class="col-lg-12 mb-20 align-center">
      <h2>COUNTDOWN</h2>
      @php
        /* $date = strtotime("March 26, 2022 1:00 PM");
        $remaining = $date - time();
        $days_remaining = floor($remaining / 86400);
        $hours_remaining = floor(($remaining % 86400) / 3600); */
        echo '<p id="response"></p>';
        /* echo '<p style="font-size:40px;"><strong>'.$days_remaining.'</strong> DAY(S) and <strong>'.$hours_remaining.'</strong> HOUR(s) left.</p>'; */
      @endphp
    </div>

    @include('pages.cms.home.partials.data')
    @include('pages.cms.home.partials.info')
    {{-- @include('pages.cms.home.partials.popular') --}}
    {{-- @include('pages.cms.home.partials.preorder') --}}
    @include('pages.cms.home.partials.news')

    @include('layouts.cms.footer')

  {{-- @include('layouts.cms.footer') --}}
  @include('layouts.cms.scripts')
  <script>
    // Set the date we're counting down to
    var countDownDate = new Date("March 26, 2022 13:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="demo"
      document.getElementById("response").innerHTML = "<p style='font-size:40px;'><strong>"+ days +"</strong> DAY(S), <strong>" + hours + "</strong> HOUR(s), <strong>" + minutes + "</strong> MINUTE(s), and <strong>" + seconds + "</strong> SECOND(s) left.</p>";

      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
      }
    }, 1000);
  </script>
@endsection
