<?php $__env->startSection('index', 'login'); ?>
<?php $__env->startSection('title', 'Login'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Login
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">Auth</a> /
        <span class="color-1">Login</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
          <h4 class="mb40">Log In</h4>
          <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <form id="login_form" method="post">
            <div id="response"></div>
            <div class="row">
              <div class="col-md-12">
                <div class="input">
                  <div class="input-wrap col-md-6 col-sm-6">
                    <input type="text" class="italic mr-1" name="user" id="user" placeholder="Username/Email" maxlength="10">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="input">
                  <div class="input-wrap col-md-6 col-sm-6">
                    <input type="password" class="general_input italic"  name="password" id="password" placeholder="Password [Max 12 Characters]" maxlength="12"><span toggle="#password" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword"></span>
                  </div>
                </div>
              </div>
              <?php if(AUTH['recaptchaEnabled'] == true && AUTH['recaptcha'] == 'code'): ?>
                <div class="input-wrap col-md-5 col-sm-5">
                  <input type="text" class="general_input italic" name="captcha" id="captcha" placeholder="Enter Captcha" maxlength="10">
                </div>
                <div class="input-wrap col-md-6 col-sm-6">
                  <img src="/auth/captcha" alt="PHP Captcha">
                </div>
              <?php else: ?>
                <input type="hidden" name="captcha" id="captcha">
              <?php endif; ?>
              <div class="col-md-12">
                <div class="input">
                  <div class="input-wrap col-md-6 col-sm-6">
                    <a href="/auth/forgotPassword" class="float-right text-white">Forgot your password?</a>
                  </div>
                </div>
              </div>
              <div class="input-wrap col-md-5 col-sm-5">
                <button class="btn gradient mt30 color-white color-white plr50 ptb19" id="login" name="login">Log In</button>
              </div>
              
              <input type="hidden" name="login" value="true"/>
            </div>
          </form>
          <?php else: ?>
            <?php echo e(abort(401)); ?>

          <?php endif; ?>
        </div>
        <?php echo $__env->make('partials.cms.widgets', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div>
  </section>
	<?php echo $__env->make('layouts.cms.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script>
    document.body.addEventListener("click", e => {
      if(e.target.closest("#login")) {
        e.preventDefault();

        const user =  document.querySelector('input[name="user"]').value;
        const pw =  document.querySelector('input[name="password"]').value;
        const captcha =  document.querySelector('input[name="captcha"]').value;
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
              captcha,
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/auth/login.blade.php ENDPATH**/ ?>