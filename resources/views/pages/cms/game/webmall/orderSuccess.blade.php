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
  <div id="exception"></div>
  @include('partials.cms.nav')
  <div class="wrapper">
    @include('partials.cms.header')
    <div class="container">
      <main class="content">
        @include('partials.cms.slider')
        <div id="content">
          <div id="box1">
            <div class="title1">
              <h1>Purchase Success!</h1>
            </div>
            <div id="content_center">
              <div class="box-style1" style="margin-bottom:55px;">
                <div class="entry">
                  @guest
                    <p>Please login to continue.</p>
                  @else
                    <p>Thank you for your purchase!</p>
                    <p>You can view your past purchases in your orders page.</p>
                  @endguest
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
      @include('partials.cms.sidebar')
    </div>
    @include('layouts.cms.footer')
  </div>
@endsection
