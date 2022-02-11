@extends('layouts.cms.app')
@section('index', 'forgotPassword')
@section('title', 'Forgot Password')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  @include('partials.cms.pageHeader')
  <section class="blog-area ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="row">
            @guest
              <div class="register-form">
                <h4 class="mb40">Forgot password?</h4>
                <form id="forgot_form" method="post">
                  <div id="response"></div>
                  <div class="row">
                    <div class="form-group input-group">
                      <input type="text" class="form-control" name="user" id="user" placeholder="UserID">
                    </div>
                    <div class="form-group input-group">
                      <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group input-group">
                      <input type="text" class="form-control" name="recKey" id="recKey" placeholder="Recovery Key">
                    </div>
                    <div class="form-group input-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="New Password"><span toggle="#password" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword"></span>
                    </div>
                    <div class="form-group input-group">
                      <input type="password" class="form-control" name="cpassword" id="password2" placeholder="Confirm New Password"><span toggle="#cpassword" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword2"></span>
                    </div>
                    @if (AUTH['recaptchaEnabled'] == true && AUTH['recaptcha'] == 'code')
                      <div class="form-group input-group col-md-6 col-sm-6">
                        <input type="text" class="form-control" name="captcha" id="captcha" placeholder="Enter Captcha">
                      </div>
                      <div class="">
                        <img src="/auth/captcha" alt="PHP Captcha">
                      </div>
                    @else
                      <input type="hidden" name="captcha" id="captcha">
                    @endif
                    <div class="form-group input-group text-center">
                      <button class="default-btn" id="resetPw" name="resetPw">Reset Password</button>
                    </div>
                  </div>
                </form>
              </div>
            @else
              {{abort(401)}}
            @endguest
          </div>
        </div>
        @include('partials.cms.widgets')
      </div>
    </div>
  </section>
  @include('layouts.cms.footer')
    <script>
    const resetPw = document.getElementById('resetPw');
    resetPw.addEventListener('click', e => {
        e.preventDefault();

        const user =  document.querySelector('input[name="user"]').value;
        const email =  document.querySelector('input[name="email"]').value;
        const recKey =  document.querySelector('input[name="recKey"]').value;
        const pw =  document.querySelector('input[name="password"]').value;
        const pw2 =  document.querySelector('input[name="cpassword"]').value;
        const captcha =  document.querySelector('input[name="captcha"]').value;
        const response =  document.querySelector('#response');

        fetch('/auth/forgotPasswordPost', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              user,
              email,
              recKey,
              pw,
              pw2,
              captcha
          })
        })
        .then(r => r.text())
        .then(data => {
          // Initialize the DOM parser
          var parser = new DOMParser();

          // Parse the text
          var doc = parser.parseFromString(data, "text/html");

          // You can now even select part of that html as you would in the regular DOM
          // Example:
          // var docArticle = doc.querySelector('article').innerHTML;

          //console.log(doc.documentElement);
          response.innerHTML = doc.documentElement.innerHTML;
          console.log(doc.documentElement.innerHTML);
        })
      });
  </script>
@endsection
