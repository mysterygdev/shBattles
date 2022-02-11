@extends('layouts.cms.app')
@section('index', 'login')
@section('title', 'Login')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')

    <div class="youplay-banner banner-top youplay-banner-parallax full">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-bg.jpg')"></div>

      <div class="info">
        <div>
          <div class="container align-center">
            <h1>Login</h1>
            @auth
              <h4>You are already logged in!</h4>
            @else
              <div class="youplay-login">
                <div class="youplay-form text-center">
                  <p id="response"></p>
                  <form class="login_form" method="post">
                    <div class="youplay-input">
                      <input type="text" name="login" id="login" placeholder="Username or Email">
                    </div>
                    <div class="youplay-input">
                      <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                    <button class="btn btn-default db" id="login_submit" name="sub_login">Login</button>
                  </form>
                </div>
              </div>
            @endauth
          </div>
        </div>
      </div>
    </div>
    @include('layouts.cms.footer')
    @include('layouts.cms.scripts')
    <script>
    document.body.addEventListener("click", e => {
      if(e.target.closest("#login_submit")) {
        e.preventDefault();

        const user =  document.querySelector('input[name="login"]').value;
        const pw =  document.querySelector('input[name="password"]').value;
        const login =  document.querySelector('input[name="login"]').value;
        const response =  document.querySelector('#response');

        fetch('/auth/login', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              user,
              pw,
              login,
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
      }
    });
  </script>
@endsection
