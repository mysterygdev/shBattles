@extends('layouts.cms.app')
@section('index', 'orders')
@section('title', 'Orders')
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
              <h1>Orders</h1>
            </div>
            <div id="content_center">
              <div class="box-style1" style="margin-bottom:55px;">
                <div class="entry">
                  @guest
                    <p>Please login to continue.</p>
                  @else
                    @include('pages.cms.game.webmall.partials.navigation')
                    <br><br>
                    @if (count($data['webmall']->getOrderHistory()) > 0)
                      <table>
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
