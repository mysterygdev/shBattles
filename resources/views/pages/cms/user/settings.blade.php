@extends('layouts.cms.app')
@section('index', 'settings')
@section('title', 'Settings')
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
              <li class="breadcrumb-item active" aria-current="page">Settings</li>
            </ol>
          </nav>
        </div>
        <div class="container">
          <div class="row hgap-lg vgap-lg">
            <div class="col mpl-content" data-sr="post" data-sr-duration="1000" data-sr-distance="20">
              <div class="col-lg mpl-content">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="nav-item"><a href="#general" class="nav-link active" aria-controls="general" role="tab" data-bs-toggle="tab" aria-selected="true">General</a></li>
                  <li role="presentation" class="nav-item"><a href="#security" class="nav-link" aria-controls="security" role="tab" data-bs-toggle="tab" aria-selected="false">Security</a></li>
                  <li role="presentation" class="nav-item"><a href="#notifications" class="nav-link" aria-controls="notifications" role="tab" data-bs-toggle="tab" aria-selected="false">Notifications</a></li>
                  <li role="presentation" class="nav-item"><a href="#sharedp" class="nav-link" aria-controls="sharedp" role="tab" data-bs-toggle="tab" aria-selected="false">Share DP/Send DP</a></li>
                  <li role="presentation" class="nav-item"><a href="#usercenter" class="nav-link" aria-controls="usercenter" role="tab" data-bs-toggle="tab" aria-selected="false">Quick Links/User Center</a></li>
                  <li role="presentation" class="nav-item"><a href="#usercenter" class="nav-link" aria-controls="staffcenter" role="tab" data-bs-toggle="tab" aria-selected="false">Staff Center</a></li>
                </ul>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade show active" id="general">
                    <form action="#" data-sr="user-setting" data-sr-duration="1000" data-sr-distance="20">
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>Display name</h2>
                        <div class="row hgap-sm vgap-sm">
                          <div class="col-12 col-sm-6">
                            <label for="setting_password">Display name:</label><input class="form-control" type="text" id="setting_password" name="setting_password" value="{{$data['user']->DisplayName}}" readonly><span class="form-control-bg"></span>
                          </div>
                        </div>
                      </div>
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>User name</h2>
                        <div class="row hgap-sm vgap-sm">
                          <div class="col-12 col-sm-6">
                            <label for="setting_password">User name:</label><input class="form-control" type="text" id="setting_password" name="setting_password" value="{{$data['user']->UserID}}" readonly><span class="form-control-bg"></span>
                          </div>
                        </div>

                      </div>
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>Change Password</h2>
                        <div class="row hgap-sm vgap-sm">
                          <div class="col-12 col-sm-6">
                            <label for="setting_password">Current Password:</label><input class="form-control" type="password" id="setting_password" name="setting_password" placeholder="Current Password"><span class="form-control-bg"></span>
                          </div>
                          <div class="col-12 col-sm-6">
                            <label for="setting_new_password">New Password:</label><input class="form-control" type="password" id="setting_new_password" name="setting_new_password" placeholder="New Password"><span class="form-control-bg"></span>
                          </div>
                        </div>
                        <button class="mpl-link mt-30">Change Password</button>
                      </div>
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>Change Pin</h2>
                        <div class="row hgap-sm vgap-sm">
                          <div class="col-12 col-sm-6">
                            <label for="setting_password">Current Password:</label><input class="form-control" type="password" id="setting_password" name="setting_password" placeholder="Current Password"><span class="form-control-bg"></span>
                          </div>
                          <div class="col-12 col-sm-6">
                            <label for="setting_new_password">New Password:</label><input class="form-control" type="password" id="setting_new_password" name="setting_new_password" placeholder="New Password"><span class="form-control-bg"></span>
                          </div>
                        </div>
                        <button class="mpl-link mt-30">Change Password</button>
                      </div>
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>Email</h2>
                        <span>It looks like your email is not verified. Click here to send your activation email.</span>
                        <div class="row hgap-sm vgap-sm">
                          <div class="col-12 col-sm-6">
                            <label for="setting_email">Current Email:</label><input class="form-control" type="email" id="setting_email" name="setting_email" value="play*******@gmail.com" disabled><span class="form-control-bg"></span>
                          </div>
                          <div class="col-12 col-sm-6">
                            <label for="setting_new_email">New Email:</label><input class="form-control" type="email" id="setting_new_email" name="setting_new_email" placeholder="New Email"><span class="form-control-bg"></span>
                          </div>
                        </div>
                        <button class="mpl-link mt-30">Change Email</button>
                        <button class="mpl-link mt-30 float-end">Resend activation email</button>
                      </div>
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>Status</h2>
                        <div class="row hgap-sm vgap-sm">
                          <div class="col-12 col-sm-6">
                            <label for="setting_phone">Current Phone:</label><input class="form-control" type="text" id="setting_phone" name="setting_phone" value="+1 *** ** ** 11" disabled><span class="form-control-bg"></span>
                          </div>
                          <div class="col-12 col-sm-6">
                            <label for="setting_new_phone">New Phone:</label><input class="form-control" type="text" id="setting_new_phone" name="setting_new_phone" placeholder="New Phone"><span class="form-control-bg"></span>
                          </div>
                        </div>
                        <button class="mpl-link mt-30">Change Phone</button>
                      </div>
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>Points</h2>
                        <div class="row hgap-sm vgap-sm">
                          <div class="col-12 col-sm-6">
                            <label for="setting_phone">Current Phone:</label><input class="form-control" type="text" id="setting_phone" name="setting_phone" value="+1 *** ** ** 11" disabled><span class="form-control-bg"></span>
                          </div>
                          <div class="col-12 col-sm-6">
                            <label for="setting_new_phone">New Phone:</label><input class="form-control" type="text" id="setting_new_phone" name="setting_new_phone" placeholder="New Phone"><span class="form-control-bg"></span>
                          </div>
                        </div>
                        <button class="mpl-link mt-30">Change Phone</button>
                      </div>
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>Member Since</h2>
                        <div class="row hgap-sm vgap-sm">
                          <div class="col-12 col-sm-6">
                            <label for="setting_phone">Current Phone:</label><input class="form-control" type="text" id="setting_phone" name="setting_phone" value="+1 *** ** ** 11" disabled><span class="form-control-bg"></span>
                          </div>
                          <div class="col-12 col-sm-6">
                            <label for="setting_new_phone">New Phone:</label><input class="form-control" type="text" id="setting_new_phone" name="setting_new_phone" placeholder="New Phone"><span class="form-control-bg"></span>
                          </div>
                        </div>
                        <button class="mpl-link mt-30">Change Phone</button>
                      </div>
                      <div class="mpl-snippet-fill" data-sr-item="user-setting">
                        <h2>Appearance</h2>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="setting_font" name="setting_font"><label class="form-check-label" for="setting_font">Use Large Fonts</label>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="notifications">
                    <form action="#">
                      <div class="mpl-snippet-fill">
                        <h2>Notifications</h2>
                        <div class="row vgap-sm">
                          <div class="col-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="notification_update" name="notification_update" checked><label class="form-check-label" for="notification_update">Update notifications</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="notification_news" name="notification_news" checked><label class="form-check-label" for="notification_news">News notifications</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="notification_off" name="notification_off"><label class="form-check-label" for="notification_off">Turn off all notifications.</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="security">
                    <form action="#">
                      <div class="mpl-snippet-fill">
                        <h2>Security</h2>
                        <div class="row vgap-sm">
                          <div class="col-12">
                            <div class="form-check">
                              <a href="#" class="btn btn-danger">Deactivate/Disable account</a><label class="form-check-label" for="notification_off">&nbsp; This will temporaily deactivate your account.</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <p>Security Questions</p>
                          </div>
                          <div class="col-12">
                            <p>Secure Recovery Key</p>
                            <span>Export your recovery key</span>
                            <button class="btn btn-warning" id="dwnRecoveryKey" style="vertical-align: inherit !important;margin-left:2%;">
                              Export
                            </button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="staffcenter">
                    <form action="#">
                      <div class="mpl-snippet-fill">
                        <h2>Staff center</h2>
                        <div class="row vgap-sm">
                          <div class="col-12">
                            <p>Here you can find your loyalty points and staff discount codes.</p>
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
