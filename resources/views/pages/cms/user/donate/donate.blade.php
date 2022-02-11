@extends('layouts.cms.app')
@section('index', 'donate')
@section('title', 'Donate')
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
          @if(isset($_POST["SubmitBtn"]) || isset($_POST["SubmitBtn"]) && !empty($_POST["SubmitBtn"]) || !empty($_POST["SubmitBtn"]))
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
                @Separator(40)
                <div class="donate-btns">
                  <button type="submit" name="SubmitBtn" class="btn gradient color-white" value="paypal">
                    Donate with Paypal
                  </button>
                </div>
              </form>
            @else
              Sorry. At the moment there are no donation options. Please come back later.
            @endif
          @endif
        @endguest
    </div>
  </section>

    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
@endsection
