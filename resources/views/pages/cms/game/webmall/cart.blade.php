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
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Cart
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">User</a> /
        <a href="#">WebMall</a> /
        <span class="color-1">Cart</span>
      </div>
    </div>
  </div>
  </section>
  <section class="team-bl ptb150">
        <div class="container">
            <div class="row">
                <div class="container-wrapper">
                    <div class="text-center">
                        @guest
                            <p>Please login to continue.</p>
                        @else
                          {{$data['webmall']->initCart()}}
                          @if ($data['webmall']->totalItems() > 0)
                            <table class="table table-responsive">
                              <thead>
                                <tr>
                                  <th>Icon</th>
                                  <th>Product</th>
                                  <th>Cost</th>
                                  <th>Quantity</th>
                                  <th>Total</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php $cartItems = $data['webmall']->contents(); @endphp
                                @foreach($cartItems as $item)
                                  <tr>
                                    {{$data['webmall']->getTags($item['tag'])}}
                                    @if ($item['tag'])
                                      @if (($item['tag'])=='ANew')
                                      @php
                                        $item['tag'] ='New'
                                      @endphp
                                      @endif
                                      @if (($item['tag'])=='ZHot')
                                      @php
                                        $item['tag'] ='Hot'
                                      @endphp
                                      @endif
                                      <td>
                                        <img src="/resources/themes/core/images/shop_icons/{{$item['image']}}" alt="" class="img-responsive img-border {{$item['tag']}}">
                                        <div class="img-special special-{{$item['tag']}}">{{$item['tag']}}</div>
                                      </td>
                                    @else
                                      <td><img src="/resources/themes/core/images/shop_icons/{{$item['image']}}" alt="" class="img-responsive"></td>
                                    @endif
                                    <td>{{$item['name']}}</td>
						                        <td>{{$item['price']}} DP</td>
                                    <td><input class="form-control" style="color:#000;" type="number" value="{{$item['qty']}}" onchange="updateCartItem(this, '{{$item['rowid']}}')"/></td>
                                    <td>{{$item['subtotal']}}</td>
                                    <td class="">
                                      <button class="btn btn-sm btn-danger" onclick="window.location.href='/webmall/cartAction?action=removeCartItem&id={{$item['rowid']}}';">
                                      <i class="material-icons">delete</i></button>
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          @else
                            @auth
                              <p>Your cart is empty.</p>
                              <p class="text-center">
                                <a class="btn btn-sm btn-dark" href="/webmall">Return to Webmall</a>
                              </p>
                            @else
                              <p>You need to login to view your cart.</p>
                            @endauth
                          @endif
                          @if ($data['webmall']->totalItems() > 0)
                            <tr>
                              <td></td>
                              <td>
                                <a href="/webmall/checkout" class="btn gradient color-white">Checkout</a>
                              </td>
                              <td>
                                <a href="/webmall" class="btn gradient color-white">Continue Shopping</a>
                              </td>
                              <td><strong>Cart Total</strong></td>
                              <td class="text-right"><strong>{{$data['webmall']->total()}} DP</strong></td>
                              <td></td>
                            </tr>
                          @endif
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
	@include('layouts.cms.footer')
@endsection
