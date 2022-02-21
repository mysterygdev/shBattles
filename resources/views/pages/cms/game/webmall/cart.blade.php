<script>
function updateCartItem(obj,id){
    $.get("/webmall/cartAction", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>
@extends('layouts.cms.app')
@section('index', 'cart')
@section('title', 'Cart')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Cart</h2>
        @guest
          <p>Please login to continue.</p>
        @else
          <div class="col-md-9 col-md-push-3 isotope">
            {{$data['webmall']->initCart()}}
            @if ($data['webmall']->totalItems() > 0)
              @php $cartItems = $data['webmall']->contents(); @endphp
              @foreach($cartItems as $item)
                <div class="item angled-bg">
                  <div class="row">
                    <div class="col-lg-2 col-md-3 col-xs-4 shop_icon">
                      @if ($item['image'])
                        @if ($item['tag'])
                          {{$data['webmall']->getTags($item['tag'])}}
                          <img src="/resources/themes/core/images/shop_icons/{{$item['image']}}" alt="" class="img-responsive img-border {{$item['tag']}}">
                          <div class="img-special special-{{$item['tag']}}">{{$item['tag']}}</div>
                        @else
                          <img src="/resources/themes/core/images/shop_icons/{{$item['image']}}" alt="" class="img-responsive">
                        @endif
                      @endif
                    </div>
                    <div class="col-lg-10 col-md-9 col-xs-8">
                      <div class="row">
                        <div class="col-xs-6 col-md-9">
                          <h4>{{$item['name']}}</h4>
                          {{$item['desc']}}
                        </div>
                        <div class="col-xs-6 col-md-3 align-right">
                          <div class="price">
                            <strong style="margin-right:10px">x{{$item['qty']}}</strong>
                            {{$item['price']}} DP
                          </div>
                          <a href="/game/webmall/cartAction?action=removeCartItem&id={{$item['rowid']}}" class="remove fas fa-trash-alt" title="Remove Item"></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
              <div class="align-right h3 mr-20 mb-20">
                <span style="margin-right:10px;">Total: <strong>{{$data['webmall']->total()}} DP</strong></span>
              </div>
              <div class="align-left">
                <a href="/game/webmall/cartAction/?action=clearCart" class="btn btn-lg">Empty Cart</a>
              </div>
              <div class="align-right">
                <a href="/game/webmall/checkout" class="btn btn-lg">Proceed to Checkout</a>
              </div>
            @else
              @auth
                <p>Your cart is empty.</p>
                <p class="text-center">
                  <a class="btn btn-lg" href="/game/webmall">Return to Webmall</a>
                </p>
              @else
                <p>You need to login to view your cart.</p>
              @endauth
            @endif
          </div>
          @include('pages.cms.game.webmall.partials.navigation')
        @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
@endsection
