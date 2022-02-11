<aside class="sidebar">
  @guest
    <div class="sign-up-block">
      <a href="/user/register">
        <span>SIGN UP</span>Now For Free
      </a>
    </div>
    <div class="social-blocks">
      <div class="social-block social-f">
        <a href="https://www.facebook.com/Webxmu-109282590824119/">Facebook</a>
      </div>
      <div class="social-block social-y">
        <a target="_blank" href="https://youtu.be/B35zAI86e80">Youtube</a>
      </div>
      <style>
        .hero-guide-block:after {
          content: "";
        }
      </style>
    </div>
    @endguest
  @include('partials.cms.widgets')
</aside>
<script>
    document.body.addEventListener("click", e => {
      if(e.target.closest("#login_submit")) {
        e.preventDefault();

        const user =  document.querySelector('input[name="login"]').value;
        const pw =  document.querySelector('input[name="password"]').value;
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
              pw
          })
        })
        .then(r => r.text())
        .then(data => {
          var parser = new DOMParser();
          var doc = parser.parseFromString(data, "text/html");
          response.innerHTML = doc.documentElement.innerHTML;
        })
      }
    });
  </script>
