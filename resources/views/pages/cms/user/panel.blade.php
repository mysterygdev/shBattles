@extends('layouts.cms.app')
@section('index', 'panel')
@section('title', 'User Panel')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>
    </div>

    <div class="container youplay-content text-center">
      <h2 class="mt-0">User Panel</h2>
      @guest
        <p>Please login to continue.</p>
      @else
        <div role="tabpanel">
          <div class="panel-btns text-center">
            <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/details';">
              Account Details
            </button>
            <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/chars';">
              Characters
            </button>
            <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/password';">
              Change Password
            </button>
            <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/res';">
              Resurrect
            </button>
            <button type="button" class="btn btn-sm btn-dark m_auto" onclick="location.href='/user/panel/security';">
              Security
            </button>
          </div>
          <div class="panel-content text-center">
            @if (!$data['page'])
              @include('pages.cms.user.panel.details')
            @else
              @if ($data['page'] == 'details')
                @include('pages.cms.user.panel.details')
              @elseif ($data['page'] == 'chars')
                @include('pages.cms.user.panel.characters')
              @elseif ($data['page'] == 'password')
                @include('pages.cms.user.panel.changePassword')
              @elseif ($data['page'] == 'res')
                @include('pages.cms.user.panel.resurrect')
              @elseif ($data['page'] == 'security')
                @include('pages.cms.user.panel.security')
              @endif
            @endif
          </div>
          {{-- <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#account" aria-controls="account" role="tab" data-toggle="tab" aria-expanded="true">Account Details</a></li>
            <li role="presentation" class=""><a href="#chars" aria-controls="chars" role="tab" data-toggle="tab" aria-expanded="false">Characters</a></li>
            <li role="presentation"><a href="#password" aria-controls="password" role="tab" data-toggle="tab">Change Password</a></li>
            <li li role="presentation"><a href="#resurrect" aria-controls="resurrect" role="tab" data-toggle="tab">Resurrect</a></li>
            <li li role="presentation"><a href="#referer" aria-controls="referer" role="tab" data-toggle="tab">Referer System</a></li>
            <li li role="presentation"><a href="#preferences" aria-controls="preferences" role="tab" data-toggle="tab">Preferences</a></li>
          </ul> --}}
          {{-- <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="account">
              @include('pages.cms.user.panel.details')
            </div>
            <div role="tabpanel" class="tab-pane" id="chars">
              @include('pages.cms.user.panel.characters')
            </div>
            <div role="tabpanel" class="tab-pane" id="password">
              @include('pages.cms.user.panel.changePassword')
            </div>
            <div role="tabpanel" class="tab-pane" id="resurrect">
              @include('pages.cms.user.panel.resurrect')
            </div>
            <div role="tabpanel" class="tab-pane" id="referer">

            </div>
            <div role="tabpanel" class="tab-pane" id="preferences">

            </div>
          </div> --}}
        </div>
      @endguest
    </div>
  </section>

  @include('layouts.cms.footer')
  @include('layouts.cms.scripts')
  <script>
    $(document).ready(function(){
      $("button#submit").click(function(e){
        e.preventDefault();
        ajaxPOST(
          "/resources/jquery/addons/ajax/site/user/security_submit.php",
          $('form#security_form').serialize(),
          (message) => {
            $("#response").html(message)
          },
          'error'
        );
      });
      $(document).on('click', '.open_edit_details_modal', function (e) {
        e.preventDefault();

        var uid = $(this).data("id");

            $("#get_edit_details_modal #dynamic-content").html("");
            $("#get_edit_details_modal #modal-loader").show();

        $.ajax({
          type: "POST",
          url: "/resources/jquery/addons/ajax/blade/init.edit_panel_details.php",
          data: "id="+uid,
          dataType: "html"
        })
        .done(function (data) {
          $('#get_edit_details_modal #dynamic-content').html('');
          $('#get_edit_details_modal #dynamic-content').hide().html(data).fadeIn("slow");
          $('#get_edit_details_modal #modal-loader').hide("slow");
        })
        .fail(function () {
          $("#get_edit_details_modal #dynamic-content").html("<i class=\"fa fa-exclamation-triangle\"></i> Something went wrong, Please try again...");
          $("#get_edit_details_modal #modal-loader").hide();
        });
      });
    });
  </script>
@endsection
