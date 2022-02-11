@extends('layouts.cms.app')
@section('index', 'promotions')
@section('title', 'Promotions')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <div class="content-wrap">
    <div class="mpl-navbar-mobile-overlay"></div>
    <div>
      <div class="mpl-box-md">
        <br>
        <div class="container">
          <div class="row hgap-lg vgap-lg">
            <div class="col mpl-content" data-sr="post" data-sr-duration="1000" data-sr-distance="20">
              <section class="">
                <div class="mpl-banner-content mpl-box-sm">
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="col-12 col-md-10 col-lg-10 col-xl-10">
                        <div class="mpl-sign-form" data-sr="sign" data-sr-interval="100" data-sr-duration="1000" data-sr-distance="20">
                          <h1 data-sr-item="sign">Promotions</h1>
                          @guest
                            <p>Please login to continue.</p>
                          @else
                            <p>Here you can redeem promotion codes for donation points.</p>
                            <p id="response"></p>
                            <form class="form-inline" method="post">
                              <div class="form-group">
                                <input type="text" placeholder="Promotion Code" class="form-control" name="code" id="code"/>
                              </div>
                              <br>
                              <button type="submit" class="btn gradient mt30 color-white color-white plr50 ptb19" name="Promo" id="Promo" style="margin-left:10px;">Submit</button>
                            </form>
                            @if (isset($_POST['Promo']))
                              @if(empty($data['promotions']->fet))
                                Code not found.
                              @else
                                @if($data['promotions']->NumOfUses==$data['promotions']->MaxUses || $data['promotions']->NumOfUses>$data['promotions']->MaxUses)
                                  Code has reached maximum number of uses.
                                @else
                                  @php $data['promotions']->validations(); @endphp
                                  Successfully redeemed code: {{$data['promotions']->Code}}
                                  for {{$data['promotions']->Points}} Donation Points.
                                @endif
                              @endif
                            @endif
                          @endguest
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
