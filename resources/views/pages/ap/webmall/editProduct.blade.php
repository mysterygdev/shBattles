@extends('layouts.ap.app')
@section('index', 'editProduct')
@section('title', 'Edit Product')
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
                        @if (!isset($_GET['id']))
                          No product id specified.
                        @else
                          @if (!is_numeric($_GET['id']))
                            Product Id must be a numeric value.
                          @else
                            @if (isset($_POST['submit']))
                              @php
                                $data['editProduct']->updateProductById($_GET['id']);
                              @endphp
                            @endif
                            @if (count($data['editProduct']->getProductById($_GET['id'])) > 0)
                              <div class="card-header text-center">
                                <h5>Editing product:
                                  <strong class="font-weight-bold">{{$data['editProduct']->getProductName($_GET['id'])}}</strong>
                                </h5>
                              </div>
                              <div class="card-body">
                                <form method="post" id="editProd">
                                  {{$data['editProduct']->loadImages()}}
                                  <p id="response"></p>
                                  @foreach ($data['editProduct']->getProductById($_GET['id']) as $fet)
                                    <div class="form-group">
                                      <label for="ProductName">Product Name</label>
                                      <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter product name" value="{{isset($fet->ProductName) ? $fet->ProductName : ''}}">
                                      <small id="ProductName" class="form-text text-muted">Product Name</small>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductDesc">Product Description</label>
                                      <input type="text" class="form-control" id="ProductDesc" name="ProductDesc" placeholder="Enter product description" value="{{isset($fet->ProductDesc) ? $fet->ProductDesc : ''}}">
                                      <small id="ProductDesc" class="form-text text-muted">Product Description</small>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductCurrency">Product Currency</label>
                                      <input type="text" class="form-control" id="ProductCurrency" name="ProductCurrency" placeholder="Enter product cost" value="{{isset($fet->ProductCurrency) ? $fet->ProductCurrency : ''}}">
                                      <small id="ProductCurrency" class="form-text text-muted">Product Currency</small>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductCost">Product Cost</label>
                                      <input type="text" class="form-control" id="ProductCost" name="ProductCost" placeholder="Enter product cost" value="{{isset($fet->ProductCost) ? $fet->ProductCost : ''}}">
                                      <small id="ProductCost" class="form-text text-muted">Product Cost</small>
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductCategory">Product Category</label>
                                      @if (!empty((WEBMALL['categories'])))
                                        <select name="category" class="form-control">
                                          {{-- <option value="n/a">Select a category..</option> --}}
                                            @foreach (WEBMALL['categories'] as $id => $category)
                                              <option value="{{$id}}" {{($fet->Category == $id) ? 'selected="selected"' : ''}}>{{$category}}</option>
                                            @endforeach
                                        </select>
                                        <small id="ProductCategory" class="form-text text-muted">Product Category</small>
                                      @else
                                        <p>
                                          It looks like there are no category options. Please make edits to the corresponding configuration file.
                                        </p>
                                      @endif
                                    </div>
                                    <div class="form-group">
                                      <label for="ProductTag">Product Tag</label>
                                      @if (!empty((WEBMALL['tags'])))
                                        <select name="tag" class="form-control">
                                          <option value="n/a">Select a tag..</option>
                                          @foreach (WEBMALL['tags'] as $id => $tag)
                                            <option value="{{$id}}" {{($fet->Tag == $id) ? 'selected="selected"' : ''}}>{{$tag}}</option>
                                          @endforeach
                                        </select>
                                        <small id="ProductTag" class="form-text text-muted">Product Tag</small>
                                      @else
                                        It looks like there are no tag options. Please make edits to the corresponding configuration file.
                                      @endif
                                    </div>
                                    @php
                                      //var_dump($data['editProduct']->getProductItemIds($_GET['id']));
                                      /* foreach ($data['editProduct']->getProductItemIds($_GET['id']) as $res) {
                                        echo 'ssd';
                                      } */
                                    @endphp
                                    <div class="col-sm-4 form-group input_fields_wrap">
                                      @php $index=1; @endphp
                                      @foreach ($data['editProduct']->getProductItemIds($_GET['id']) as $res)
                                        <div class="input-group mb-3">
                                          <input type="text" class="form-control" name="Prod[ItemID][]" placeholder="Item ID" value="{{$res->ItemID}}">
                                          <input type="text" class="mx-3 form-control" name="Prod[ItemCount][]" placeholder="Item Count" value="{{$res->ItemCount}}">
                                          @if ($index > 1)
                                            <button class="btn btn-danger remove_field">X</button>
                                          @else
                                            <button class="btn btn-primary add_field_button">+</button>
                                          @endif
                                        </div>
                                        @php $index++; @endphp
                                      @endforeach
                                    </div>
                                    @Separator(20)
                                    <button class="btn btn-sm btn-primary" name="submit" id="submit" data-id="{{$_GET['id']}}">Save Changes</button>
                                  @endforeach
                                </form>
                              </div>
                              <!-- foreach -->
                            @else
                              <div class="card-header text-center">
                                Product doesn't exist.
                              </div>
                              <div class="card-body">
                                Product doesn't exist.
                              </div>
                            @endif
                          @endif
                        @endif
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
  <script>
    $(document).ready(function(){
      $("button#submit").click(function(e){
        e.preventDefault();
        var uid = $(this).data("id");
        ajaxPOST(
          "/resources/jquery/addons/ajax/admin/webmall/product_edit.php",
          $('form#editProd').serialize() + "&id="+uid,
          (message) => {
            $("#response").html(message)
          },
          'error'
        );
        /* ajaxPOST(
          '/resources/jquery/addons/ajax/admin/webmall/product_edit.php',
          1,
          (message) => {
            alert("gg");
            $("#response").html(message)
          },
          (error) => {
            'Error'
          },
        ) */
      });
    });
  </script>
@endsection
