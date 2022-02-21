@extends('layouts.cms.app')
@section('index', 'orders')
@section('title', 'Orders')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Orders</h2>
        @guest
          <p>Please login to continue.</p>
        @else
          <div class="col-md-9 col-md-push-3 isotope">
            @if (count($data['webmall']->getOrderHistory()) > 0)
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Order #</th>
                    <th>Product Name</th>
                    <th>Product Desc</th>
                    <th>Product Cost</th>
                    <th>Product Quantity</th>
                    <th>Order Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data['webmall']->getOrderHistory() as $fet)
                  <tr>
                    <td>{{$fet->OrderNumber}}</td>
                    <td>{{$fet->ItemName}}</td>
                    <td>{{$fet->ItemDesc}}</td>
                    <td>{{$fet->ItemCost}}</td>
                    <td>{{$fet->ItemQuantity}}</td>
                    <td>{{date('F d, Y', strtotime($fet->Date))}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            @else
              It appears that you have not placed any orders. Please come back later.
            @endif
          </div>
          @include('pages.cms.game.webmall.partials.navigation')
        @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
@endsection
