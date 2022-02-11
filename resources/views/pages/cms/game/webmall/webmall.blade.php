@extends('layouts.cms.app')
@section('index', 'webmall')
@section('title', 'Webmall')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Webmall
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <span class="color-1">WebMall</span>
      </div>
    </div>
  </div>
  </section>
  <section class="ptb150">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 col-md-8 col-lg-8 col-sm-push-5 col-md-push-4 col-lg-push-4">
                    <div class="games-container">
                        @guest
                            <p>Please login to continue.</p>
                        @else
                            <p>Your available PvP Points to spend:
                                <span class="fw_bold">{{$data['webmall']->getUserPoints()}}</span>
                            </p>
                            @if (count($data['webmall']->getProducts()) > 0)
                                @foreach ($data['webmall']->getProducts() as $res)
                                    <div class="g-item col-lg-4 col-md-4 col-sm-4 col-xs-12 mb30 wow fadeInUp" data-wow-duration="1s">
                                        <form method="post" name="ItemSubmit" action="/webmall/cartAction?action=addToCart&id={{$res->ProductID}}">
                                            <div class="bottom-container">
                                                <div class="text-center mt20">
                                                    <div class="float-left" style="margin-left:40%;">
                                                        {{$data['webmall']->getTags($res->Tag)}}
                                                        @if ($res->Tag)
                                                            @if (($res->Tag)=='ANew')
                                                                @php
                                                                    $res->Tag ='New'
                                                                @endphp
                                                            @endif
                                                            @if (($res->Tag)=='ZHot')
                                                                @php
                                                                    $res->Tag ='Hot'
                                                                @endphp
                                                            @endif
                                                            <img src="/resources/themes/core/images/shop_icons/{{$res->ProductImage}}" alt="" class="img-responsive img-border {{$res->Tag}}">
                                                            <div class="img-special special-{{$res->Tag}}">{{$res->Tag}}</div>
                                                        @else
                                                            <img src="/resources/themes/core/images/shop_icons/{{$res->ProductImage}}" alt="" class="img-responsive">
                                                        @endif
                                                    </div>
                                                    <a href="#" class="name font-agency fweight-700 lheight-32 color-white" style="align: center;">
                                                        {{$res->ProductName}}
                                                    </a>
                                                    <div class="position mt666">
                                                        <span style="color:#AFA; padding-left: 30px; margin-top: 3%; font-size: 10pt;" class="float-left">
                                                            {{$res->ProductCost}}
                                                            @if (($res->ProductCost)==1)
                                                            DP
                                                            @else
                                                            DPs
                                                            @endif
                                                        </span>
                                                        <div class="float-right" style="padding-right: 20px;">
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
                                                        </div>
                                                    </div><br>
                                                    <div class="social mt20">
                                                        @Separator(40)
                                                        <input type="submit" class="btn gradient color-white" value="Add to cart"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endforeach
                            @endif
                        @endguest
                    </div>
                </div>
                @include('pages.cms.game.webmall.partials.navigation')
            </div>
        </div>
    </section>
	@include('layouts.cms.footer')
@endsection
