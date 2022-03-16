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
                      <div class="card">
                        @if (!isset($_GET['id']))
                          No product id specified.
                        @else
                          @if (!is_numeric($_GET['id']))
                            Product Id must be a numeric value.
                          @else
                            @if (count($data['editProduct']->getProductById($_GET['id'])) > 0)
                              <div class="card-header text-center">
                                <h5>Editing product:
                                  <strong class="font-weight-bold">{{$data['editProduct']->getProductName($_GET['id'])}}</strong>
                                </h5>
                              </div>
                              <div class="card-body">
                                ok
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
@endsection
