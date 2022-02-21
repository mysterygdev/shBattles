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
@section('index', 'orderSuccess')
@section('title', 'Order Success')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Purchase Success!</h2>
        @guest
          <p>Please login to continue.</p>
        @else
          <p>Thank you for your purchase!</p>
          <p>You can view your past purchases in your orders page.</p>
        @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
@endsection
