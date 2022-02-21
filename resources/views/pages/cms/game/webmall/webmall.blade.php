@extends('layouts.cms.app')
@section('index', 'webmall')
@section('title', 'Webmall')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-store">
      <h2 class="mt-0">Webmall</h2>
      @guest
        <p>Please login to continue.</p>
      @else
        <div class="col-md-9 col-md-push-3 isotope">
          <h2 class="text-center">Your available points to spend: <span class="fw_bold">{{$data['webmall']->getUserPoints()}}</span></h2>
          <h3 class="text-center">{{$data['webmall']->category}}</h3>
          <div class="isotope-list">
            @if (count($data['webmall']->getProducts()) > 0)
              @foreach ($data['webmall']->getProducts() as $res)
                <form method="post" name="ItemSubmit" action="/game/webmall/cartAction?action=addToCart&id={{$res->ProductID}}">
                  <a href="#!" class="item angled-bg" data-filters="popular">
                    <div class="row">
                      <div class="col-lg-2 col-md-3 col-xs-4 shop_icon">
                        {{$data['webmall']->getTags($res->Tag)}}
                        @if ($res->Tag)
                          <img class="img-border {{$res->Tag}}" src="/resources/themes/core/images/shop_icons/{{$res->ProductImage}}" alt="">
                          <div class="img-special special-{{$res->Tag}}">{{$res->Tag}}</div>
                        @else
                          <img src="/resources/themes/core/images/shop_icons/{{$res->ProductImage}}" alt="">
                        @endif
                      </div>
                      <div class="col-lg-10 col-md-9 col-xs-8">
                        <div class="row">
                          <div class="col-xs-6 col-md-9">
                            <h2>{{$res->ProductName}}</h2>
                            <p>{{$res->ProductDesc}}</p>
                          </div>
                          <div class="col-xs-6 col-md-3 align-right">
                            <div class="price">
                              {{$res->ProductCost}} DP
                            </div>
                            <select name="Quantity" class="custom-select custom-select-sm form-control form-control-sm">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="15">15</option>
                              <option value="20">20</option>
                              <option value="30">30</option>
                              <option value="40">40</option>
                              <option value="50">50</option>
                            </select>
                            @Separator(40)
                            <button type="submit" class="btn btn-sm">Add To Cart</button>
                            @Separator(20)
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </form>
              @endforeach
            @endif
          </div>
        </div>
        @include('pages.cms.game.webmall.partials.navigation')
      @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
@endsection
