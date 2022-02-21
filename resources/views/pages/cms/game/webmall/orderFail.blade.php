<script>
function updateCartItem(obj,id){
    $.get("/game/webmall/cartAction", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
</script>
@extends('layouts.cms.app')
@section('index', 'orderFail')
@section('title', 'Order Fail')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Purchase Failed!</h2>
        @guest
          <p>Please login to continue.</p>
        @else
          <p>You do not have enough points to purchase this!</p>
          <a href="/game/webmall" class="custom_button" style="text-transform: none;">Back to webmall</a>
          <a href="/game/webmall/cart" class="custom_button" style="text-transform: none;">Back to cart</a>
        @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
@endsection
