@extends('layouts.ap.app')
@section('index', 'manageProducts')
@section('title', 'Manage Products')
@section('zone', 'AP')
@section('content')
  @include('partials.ap.nav')
  @include('partials.ap.header')
  <div class="pcoded-main-container">
    <div class="pcoded-wrapper">
      <div class="pcoded-content">
        <div class="pcoded-inner-content">
          {{-- is logged in and is staff --}}
          @if($data['user']->isAuthorized())
            {{-- is adm, gm or gma --}}
            @if($data['user']->isADM() || $data['user']->isGM() || $data['user']->isGMA())
              <div class="main-body">
                <div class="page-wrapper">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">
                        <div class="card-header text-center">
                          <h5 class="">Manage products</h5>
                          <div class="float-right">
                            <button type="button" class="btn btn-sm btn-primary"  onclick="window.open('/admin/webmall/addProduct','_self')">Add New Product</button>
                          </div>
                        </div>
                        <div class="card-body">
                          <!-- need paginator for other pages of products, maybe datatables?? homepage example?? -->
                          @if (count($data['manageProducts']->getProducts()) > 0)
                            <table class="table table-striped" id="NewPlayers">
                              <thead>
                                <tr>
                                  <th>ID</th>
                                  <th>Name</th>
                                  <th>Cost</th>
                                  <th>Image</th>
                                  <th>Category</th>
                                  <th>Tag</th>
                                  {{-- <th>Count</th> --}}
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                @foreach ($data['manageProducts']->getProducts() as $fet)
                                  <tr>
                                    <td>{{$fet->ProductID}}</td>
                                    <td>{{$fet->ProductName}}</td>
                                    <td>{{$fet->ProductCost}}</td>
                                    <td><img src="/resources/themes/core/images/shop_icons/{{$fet->ProductImage}}.png"></td>
                                    <td>{{WEBMALL['categories'][$fet->Category]}}</td>
                                    <td>{{WEBMALL['tags'][$fet->Tag]}}</td>
                                    {{-- <td>3</td> --}}
                                    <td><button type="button" class="btn btn-sm btn-primary" name="submit" onclick="window.open('/admin/webmall/editProduct?id={{$fet->ProductID}}','_target')">Edit</button></td>
                                    <td><button type="submit" class="btn btn-sm btn-danger open_mp_rmv_modal" data-toggle="modal" data-id="{{$fet->ProductID}}~{{$fet->ProductName}}~{{$fet->ProductCode}}" data-target="#get_mP_rmv_modal">Remove</button></td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          @else
                            There are currently no products.
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @else
            {{redirect('/admin/auth/login')}}
          @endif
        </div>
      </div>
    </div>
  </div>
  {{display('get_mP_rmv_modal','','0','2','Confirm Product Removal')}}
  <!-- Are you sure you want to remove this product? yes : no -->
  <script>
    $(document).on('click', '.open_mp_rmv_modal', function (e) {
      e.preventDefault();

      var uid = $(this).data("id");

          $("#get_mP_rmv_modal #dynamic-content").html("");
          $("#get_mP_rmv_modal #modal-loader").show();

      $.ajax({
        type: "POST",
        url: "/resources/jquery/addons/ajax/blade/init.products_remove.php",
        data: "id="+uid,
        dataType: "html"
      })
      .done(function (data) {
        $('#get_mP_rmv_modal #dynamic-content').html('');
        $('#get_mP_rmv_modal #dynamic-content').hide().html(data).fadeIn("slow");
        $('#get_mP_rmv_modal #modal-loader').hide("slow");
      })
      .fail(function () {
        $("#get_mP_rmv_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
              $("#get_mP_rmv_modal #modal-loader").hide();
      });
    });
  </script>
@endsection
