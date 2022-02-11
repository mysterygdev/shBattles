@extends('layouts.cms.app')
@section('index', 'panel')
@section('title', 'User Panel')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  <div class="content-wrap">
    <div class="mpl-navbar-mobile-overlay"></div>
    <div>
      <div class="mpl-box-md">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs container mpl-box-md">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active" aria-current="page">Panel</li>
            </ol>
          </nav>
        </div>
        <div class="container">
          @guest
            <p>Please login to continue.</p>
          @else
          @endguest
          <div class="row hgap-lg vgap-lg">
            <div class="col mpl-content" data-sr="post" data-sr-duration="1000" data-sr-distance="20">
              <div class="col-lg mpl-content">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="nav-item"><a href="#uc" class="nav-link active" aria-controls="uc" role="tab" data-bs-toggle="tab" aria-selected="true">User Center</a></li>
                  <li role="presentation" class="nav-item"><a href="#sp" class="nav-link" aria-controls="sp" role="tab" data-bs-toggle="tab" aria-selected="false">Send DP</a></li>
                </ul>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade show active" id="uc">
                    <form action="#">
                      <div class="mpl-snippet-fill">
                        <h2>User center</h2>
                        <div class="row vgap-sm">
                          <div class="col-12">
                            <p>Welcome. [Dev]Velocity to your user center. Here's some things you can do:</p>
                            <ul class="uc-nav">
                              <li><a href="#">Donate </a></li>
                              <li><a href="#">Trade Gold for DP </a></li>
                              <li><a href="#">Send DP </a></li>
                              <li><a href="#">Redeem Points </a></li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="sp">
                    <form action="#">
                      <div class="mpl-snippet-fill">
                        <h2>Send DP</h2>
                        <div class="row vgap-sm">
                          <div class="col-12">
                            <p>send points.</p>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            @include('partials.cms.widgets')
          </div>
        </div>
      </div>
    @include('layouts.cms.footer')
    </div>
  </div>
  @include('layouts.cms.scripts')
@endsection
