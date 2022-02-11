
<?php $__env->startSection('index', 'register'); ?>
<?php $__env->startSection('title', 'Register'); ?>
<?php $__env->startSection('zone', 'CMS'); ?>
<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('partials.cms.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <section class="page-name parallax" data-paroller-factor="0.1" data-paroller-type="background" data-paroller-direction="vertical">
  <div class="container">
    <div class="row">
      <h1 class="page-title">
        Register
      </h1>
      <div class="breadcrumbs">
        <a href="#">Home</a> /
        <a href="#">Auth</a> /
        <span class="color-1">Register</span>
      </div>
    </div>
  </div>
  </section>
  <section class="blog-content ptb150 each-element">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
          <h4 class="mb40">Create an account</h4>
          <div id="response"></div>
          <div id="responseVerify1"></div>
          <div id="responseVerify2"></div>
          <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <form id="register_form" method="post">
            <div class="row">
              <div class="col-md-12">
                <div class="input">
                  <div class="input-wrap col-md-5 col-sm-5">
                    <input type="text" class="italic mr-1" name="displayname" id="displayname" placeholder="Display Name" maxlength="10">
                  </div>
                  <div class="input-wrap col-md-6 col-sm-6">
                    <button class="btn gradient ml10 color-white color-white plr50 ptb19" id="verify_display">Verify</button>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="input">
                  <div class="input-wrap col-md-5 col-sm-5">
                    <input type="text" class="italic mr-1" name="username" id="username" placeholder="Username" maxlength="16">
                  </div>
                  <div class="input-wrap col-md-6 col-sm-6">
                    <button class="btn gradient ml10 color-white color-white plr50 ptb19" id="verify_user">Verify</button>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="input">
                  <div class="input-wrap col-md-5 col-sm-5">
                    <input type="text" class="italic mr-1" name="email" id="email" placeholder="Email" maxlength="32">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="input">
                  <div class="input-wrap col-md-5 col-sm-5">
                    <input type="password" class="general_input italic"  name="password" id="password" placeholder="Password [Max 12 Characters]" maxlength="12"><span toggle="#password" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword"></span>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="input">
                  <div class="input-wrap col-md-5 col-sm-5">
                    <input type="password" class="general_input italic" name="cpassword" id="password2" placeholder="Confirm Password [Max 12 Characters]" maxlength="12"><span toggle="#cpassword" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword2"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
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
              <div class="input-wrap col-md-11">
                <button class="btn gradient mt30 color-white color-white plr50 ptb19" id="register">Create Account</button>
              </div>
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
    const verifyDisplay = document.getElementById('verify_display');
    verifyDisplay.addEventListener('click', e => {
      e.preventDefault();

      const display =  document.querySelector('input[name="displayname"]').value;

      const response =  document.querySelector('#responseVerify1');

      fetch('/auth/verifyDisplayName', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              display
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
        })

    });
    const verifyUser = document.getElementById('verify_user');
    verifyUser.addEventListener('click', e => {
      e.preventDefault();

      const user =  document.querySelector('input[name="username"]').value;

      const response =  document.querySelector('#responseVerify2');

      fetch('/auth/verifyUserName', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              user
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
        })

    });
    document.body.addEventListener("click", e => {
      if(e.target.closest("#register")) {
        e.preventDefault();

        const display =  document.querySelector('input[name="displayname"]').value;
        const user =  document.querySelector('input[name="username"]').value;
        const email =  document.querySelector('input[name="email"]').value;
        const pw =  document.querySelector('input[name="password"]').value;
        const cpw =  document.querySelector('input[name="cpassword"]').value;

        const response =  document.querySelector('#response');

        fetch('/auth/register', {
          method: 'post',
          mode: "same-origin",
          credentials: "same-origin",
          headers: {
              "Content-Type": "application/json"
          },
          body: JSON.stringify({
              display,
              user,
              email,
              pw,
              cpw,
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
        })
      }
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.cms.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/pages/cms/auth/register.blade.php ENDPATH**/ ?>