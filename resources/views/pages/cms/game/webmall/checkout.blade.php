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
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Review Order</h2>
        @guest
          <p>Please login to continue.</p>
        @else
          <table class="table table-striped">
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
                <p class="text-left">
                  <strong>Coupon code</strong>
                  <div class="col-md-3">
                    <div class="youplay-input">
                      <input type="text" name="couponCode" id="couponCode" placeholder="Coupon code">
                    </div>
                    <p id="responseCoupon"></p>
                    <button type="submit" class="btn btn-sm" name="couponSubmit" id="couponSubmit">Apply</button>
                  </div>
                </p>
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
            <button type="submit" class="btn btn-md" name="checkoutSubmit">Place Order</button>
          </form>
        @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
  <script>
    document.body.addEventListener("click", e => {
      if(e.target.closest("#couponSubmit")) {
        e.preventDefault();

        const code =  document.querySelector('input[name="couponCode"]').value;
        const response =  document.querySelector('#responseCoupon');

        fetch('/game/webmall/couponAdd', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              code
          })
        })
        .then(r => r.text())
        .then(data => {
          var parser = new DOMParser();
          var doc = parser.parseFromString(data, "text/html");
          response.innerHTML = doc.documentElement.innerHTML;
          console.log(doc.documentElement.innerHTML);
        })
      }
    });
  </script>
@endsection
