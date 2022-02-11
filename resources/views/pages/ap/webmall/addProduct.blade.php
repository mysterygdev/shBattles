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
                          <p>First select an image, and then fill out the rest of the information.</p>
                          <p>Only one Item id and count are required. fill out as many as you like to create a package product.</p>

                          @php
                            echo $data['addProduct']->getPagination();
                          @endphp

                          <p id="response"></p>

                          <div class="form-group">
                            <label for="ProductCode">Product Code</label>
                            <input type="text" class="form-control" id="ProductCode" name="ProductCode" aria-describedby="ProductCode" placeholder="Enter product code">
                            <small id="ProductCode" class="form-text text-muted">Special Identifier for product</small>
                          </div>
                          <div class="form-group">
                            <label for="ProductName">Product Name</label>
                            <input type="text" class="form-control" id="ProductName" name="ProductName" aria-describedby="ProductName" placeholder="Enter product name">
                            <small id="ProductName" class="form-text text-muted">Product Name</small>
                          </div>
                          <div class="form-group">
                            <label for="ProductDesc">Product Description</label>
                            <input type="text" class="form-control" id="ProductDesc" name="ProductDesc" aria-describedby="ProductDesc" placeholder="Enter product description">
                            <small id="ProductDesc" class="form-text text-muted">Product Description</small>
                          </div>
                          <div class="form-group">
                            <label for="ProductCost">Product Cost</label>
                            <input type="text" class="form-control" id="ProductCost" name="ProductCost" aria-describedby="ProductCost" placeholder="Enter product cost">
                            <small id="ProductCost" class="form-text text-muted">Product Cost</small>
                          </div>
                          <div class="form-group">
                            <label for="ProductCategory">Product Category</label>
                          </div>
                          <div class="form-group">
                            <label for="ProductTag">Product Tag</label>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID1">Item ID 1</label>
                                <input type="text" class="form-control" id="ItemID1" name="ItemID1" aria-describedby="ItemID1" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount1">Item Count 1</label>
                                <input type="text" class="form-control" id="ItemCount1" name="ItemCount1" aria-describedby="ItemCount1" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID2">Item ID 2</label>
                                <input type="text" class="form-control" id="ItemID2" name="ItemID2" aria-describedby="ItemID2" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount2">Item Count 2</label>
                                <input type="text" class="form-control" id="ItemCount2" name="ItemCount2" aria-describedby="ItemCount2" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID3">Item ID 3</label>
                                <input type="text" class="form-control" id="ItemID3" name="ItemID3" aria-describedby="ItemID3" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount3">Item Count 3</label>
                                <input type="text" class="form-control" id="ItemCount3" name="ItemCount3" aria-describedby="ItemCount3" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID4">Item ID 4</label>
                                <input type="text" class="form-control" id="ItemID4" name="ItemID4" aria-describedby="ItemID4" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount4">Item Count 4</label>
                                <input type="text" class="form-control" id="ItemCount4" name="ItemCount4" aria-describedby="ItemCount4" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID5">Item ID 5</label>
                                <input type="text" class="form-control" id="ItemID5" name="ItemID5" aria-describedby="ItemID5" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount5">Item Count 5</label>
                                <input type="text" class="form-control" id="ItemCount5" name="ItemCount5" aria-describedby="ItemCount5" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID6">Item ID 6</label>
                                <input type="text" class="form-control" id="ItemID6" name="ItemID6" aria-describedby="ItemID6" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount6">Item Count 6</label>
                                <input type="text" class="form-control" id="ItemCount6" name="ItemCount6" aria-describedby="ItemCount6" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID7">Item ID 7</label>
                                <input type="text" class="form-control" id="ItemID7" name="ItemID7" aria-describedby="ItemID7" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount7">Item Count 7</label>
                                <input type="text" class="form-control" id="ItemCount7" name="ItemCount7" aria-describedby="ItemCount7" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID8">Item ID 8</label>
                                <input type="text" class="form-control" id="ItemID8" name="ItemID8" aria-describedby="ItemID8" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount8">Item Count 8</label>
                                <input type="text" class="form-control" id="ItemCount8" name="ItemCount8" aria-describedby="ItemCount8" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID9">Item ID 9</label>
                                <input type="text" class="form-control" id="ItemID9" name="ItemID9" aria-describedby="ItemID9" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount9">Item Count 9</label>
                                <input type="text" class="form-control" id="ItemCount9" name="ItemCount9" aria-describedby="ItemCount9" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID10">Item ID 10</label>
                                <input type="text" class="form-control" id="ItemID10" name="ItemID10" aria-describedby="ItemID10" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount10">Item Count 10</label>
                                <input type="text" class="form-control" id="ItemCount10" name="ItemCount10" aria-describedby="ItemCount10" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID11">Item ID 11</label>
                                <input type="text" class="form-control" id="ItemID11" name="ItemID11" aria-describedby="ItemID11" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount11">Item Count 11</label>
                                <input type="text" class="form-control" id="ItemCount11" name="ItemCount11" aria-describedby="ItemCount11" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID12">Item ID 12</label>
                                <input type="text" class="form-control" id="ItemID12" name="ItemID12" aria-describedby="ItemID12" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount12">Item Count 12</label>
                                <input type="text" class="form-control" id="ItemCount12" name="ItemCount12" aria-describedby="ItemCount12" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID13">Item ID 13</label>
                                <input type="text" class="form-control" id="ItemID13" name="ItemID13" aria-describedby="ItemID13" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount13">Item Count 13</label>
                                <input type="text" class="form-control" id="ItemCount13" name="ItemCount13" aria-describedby="ItemCount13" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID14">Item ID 14</label>
                                <input type="text" class="form-control" id="ItemID14" name="ItemID14" aria-describedby="ItemID14" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount14">Item Count 14</label>
                                <input type="text" class="form-control" id="ItemCount14" name="ItemCount14" aria-describedby="ItemCount14" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID15">Item ID 15</label>
                                <input type="text" class="form-control" id="ItemID15" name="ItemID15" aria-describedby="ItemID15" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount15">Item Count 15</label>
                                <input type="text" class="form-control" id="ItemCount15" name="ItemCount15" aria-describedby="ItemCount15" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID16">Item ID 16</label>
                                <input type="text" class="form-control" id="ItemID16" name="ItemID16" aria-describedby="ItemID16" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount16">Item Count 16</label>
                                <input type="text" class="form-control" id="ItemCount16" name="ItemCount16" aria-describedby="ItemCount16" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID17">Item ID 17</label>
                                <input type="text" class="form-control" id="ItemID17" name="ItemID17" aria-describedby="ItemID17" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount17">Item Count 17</label>
                                <input type="text" class="form-control" id="ItemCount17" name="ItemCount17" aria-describedby="ItemCount17" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID18">Item ID 18</label>
                                <input type="text" class="form-control" id="ItemID18" name="ItemID18" aria-describedby="ItemID18" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount18">Item Count 18</label>
                                <input type="text" class="form-control" id="ItemCount18" name="ItemCount18" aria-describedby="ItemCount18" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID19">Item ID 19</label>
                                <input type="text" class="form-control" id="ItemID19" name="ItemID19" aria-describedby="ItemID19" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount19">Item Count 19</label>
                                <input type="text" class="form-control" id="ItemCount19" name="ItemCount19" aria-describedby="ItemCount19" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
                          <div class="form-inline">
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label for="ItemID20">Item ID 20</label>
                                <input type="text" class="form-control" id="ItemID20" name="ItemID20" aria-describedby="ItemID20" placeholder="Enter product id">
                              </div>
                            </div>
                            <div class="col-sm-3" style="margin-left:10%;">
                              <div class="form-group">
                                <label for="ItemCount20">Item Count 20</label>
                                <input type="text" class="form-control" id="ItemCount20" name="ItemCount20" aria-describedby="ItemCount20" placeholder="Enter product count">
                              </div>
                            </div>
                          </div>
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
