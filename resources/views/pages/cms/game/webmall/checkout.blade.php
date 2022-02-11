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
@section('index', 'checkout')
@section('title', 'Checkout')
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
              <h1>Review Order</h1>
            </div>
            <div id="content_center">
              <div class="box-style1" style="margin-bottom:55px;">
                <div class="entry">
                  @guest
                    <p>Please login to continue.</p>
                  @else
                    <table>
                      <thead>
                        <tr>
                          <th>Icon</th>
                          <th>Product</th>
                          <th>Cost</th>
                          <th>Quantity</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php $cartItems = $data['webmall']->contents(); @endphp
                        @foreach($cartItems as $item)
                          <tr>
                            {{$data['webmall']->getTags($item['tag'])}}
                            @if ($item['tag'])
                              <td>
                                <img src="/resources/themes/core/images/shop_icons/{{$item['image']}}" alt="" class="img-responsive img-border {{$item['tag']}}">
                                <div class="img-special special-{{$item['tag']}}">{{$item['tag']}}</div>
                              </td>
                            @else
                              <td><img src="/resources/themes/core/images/shop_icons/{{$item['image']}}" alt="" class="img-responsive"></td>
                            @endif
                            <td>{{$item['name']}}</td>
                            <td>{{$item['price']}} DP</td>
                            <td>{{$item['qty']}}</td>
                            <td>{{$item['subtotal']}}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @if ($data['webmall']->totalItems() > 0)
                    <tr>
                      <td></td>
                      <td>
                        <a href="/game/webmall" class="custom_button" style="text-transform: none;">Back to webmall</a>
                      </td>
                      <td>
                        <a href="/game/webmall/cart" class="custom_button" style="text-transform: none;">Edit cart</a>
                      </td>
                      <td>
                        <p class="text-right">
                          <strong>Cart Total</strong>
                          <strong>{{$data['webmall']->total()}} DP</strong>
                        </p>
                      </td>
                      <td></td>
                    </tr>
                    @endif
                    <br><br>
                    <form method="post" action="/game/webmall/cartAction">
                      <input type="hidden" name="action" value="placeOrder"/>
                      <input class="custom_button" style="text-transform: none;" type="submit" name="checkoutSubmit" value="Place Order">
                    </form>
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
