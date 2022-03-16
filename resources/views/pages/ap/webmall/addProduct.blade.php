@extends('layouts.ap.app')
@section('index', 'sendNotice')
@section('title', 'Add Product')
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
                      <div class="card align-items-center">
                        <div class="card-header">
                          <h5>Add Product</h5>
                        </div>
                        <div class="card-body">
                          @if (isset($_POST['submit']))
                            @if (!empty($data['addProduct']->checkErrors()))
                              <!-- TODO: SHOW ALL ERRORS, NOT JUST ONE -->
                              {{-- Errors found. Please make sure you filled out all form inputs. --}}
                              @if (count($data['addProduct']->errors))
                                <ul>
                                @foreach ($data['addProduct']->errors as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                                </ul>
                              @endif
                            @else
                              @if ($data['addProduct']->insertProduct() == true)
                                <p><strong class="font-weight-bold">Product created successfully.</strong></p>
                              @else
                                Could not create new product.
                              @endif
                            @endif
                          @endif

                          <p>First select an image, and then fill out the rest of the information.</p>
                          <p>Only one Item id and count are required. fill out as many as you like to create a package product.</p>

                          <form method="post">
                            @php
                              //echo $data['addProduct']->getPagination();
                              echo $data['addProduct']->loadImages();
                            @endphp

                            <p id="response"></p>
                            {{-- <form id="form" action="">
                            </form> --}}
                            <br>
                            {{-- <button class="btn btn-sm btn-primary" name="btn2" id="btn2">Remove Last Product Input</button> --}}
                            {{-- <div class="form-group">
                              <!-- TODO: CREATE RANDOM PRODUCT CODE, FIRST CHECKING IF CODE EXISTS IN DATABASE EX: PROD_COD-->
                              <label for="ProductCode">Product Code</label>
                              <input type="text" class="form-control" id="ProductCode" name="ProductCode" aria-describedby="ProductCode" placeholder="Enter product code">
                              <small id="ProductCode" class="form-text text-muted">Special Identifier for product</small>
                            </div> --}}
                            <div class="form-group">
                              <label for="ProductName">Product Name</label>
                              <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter product name" value="{{isset($data['addProduct']->name) ? $data['addProduct']->name : ''}}">
                              <small id="ProductName" class="form-text text-muted">Product Name</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductDesc">Product Description</label>
                              <input type="text" class="form-control" id="ProductDesc" name="ProductDesc" placeholder="Enter product description" value="{{isset($data['addProduct']->desc) ? $data['addProduct']->desc : ''}}">
                              <small id="ProductDesc" class="form-text text-muted">Product Description</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductCost">Product Cost</label>
                              <input type="text" class="form-control" id="ProductCost" name="ProductCost" placeholder="Enter product cost" value="{{isset($data['addProduct']->cost) ? $data['addProduct']->cost : ''}}">
                              <small id="ProductCost" class="form-text text-muted">Product Cost</small>
                            </div>
                            <div class="form-group">
                              <label for="ProductCategory">Product Category</label>
                              @if (!empty((WEBMALL['categories'])))
                                <select name="category" class="form-control">
                                  <option value="n/a">Select a category..</option>
                                    @foreach (WEBMALL['categories'] as $id => $category)
                                      <option value="{{$id}}">{{$category}}</option>
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
                                    <option value="{{$id}}">{{$tag}}</option>
                                  @endforeach
                                </select>
                                <small id="ProductTag" class="form-text text-muted">Product Tag</small>
                              @else
                                It looks like there are no tag options. Please make edits to the corresponding configuration file.
                              @endif
                            </div>
                            <div class="col-sm-4 form-group input_fields_wrap">
                              <div class="input-group mb-3">
                                <input type="text" class="form-control" name="Prod[ItemID][]" placeholder="Item ID">
                                <input type="text" class="mx-3 form-control" name="Prod[ItemCount][]" placeholder="Item Count">
                                <button class="btn btn-primary add_field_button">+</button>
                              </div>
                            </div>
                            @Separator(20)
                            <button type="submit" class="btn btn-sm btn-primary" name="submit">Create Product</button>
                          </form>
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
@endsection
