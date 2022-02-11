<?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
  <div>
    <div id="response"></div>
    <form id="login_form" method="post">
      <div class="row">
        <div class="col-md-12">
          <div class="input">
            <div class="input-wrap col-md-10 col-sm-10">
              <input type="text" class="italic mr-1" name="login" id="login" placeholder="Username/Email" maxlength="10">
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="input">
            <div class="input-wrap col-md-10 col-sm-10">
              <input type="password" class="general_input italic" name="password" id="password" placeholder="Password [Max 12 Characters]" maxlength="12"><span toggle="#password" class="fa fa-fw fa-eye fa-eye-slash field-icon2" id="togglePassword"></span>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="input">
            <div class="input-wrap col-md-6 col-sm-6">
              <a href="/auth/forgotPassword" class="float-right text-white">Forgot your password?</a>
            </div>
          </div>
        </div>
        <div class="input-wrap col-md-5 col-sm-5">
          <button class="btn gradient mt30 color-white color-white plr50 ptb19" id="login_submit" name="login">Log In</button>
        </div>
        <input type="hidden" name="login" value="true"/>
    </form>
  </div>
  <br>
<?php else: ?>
  <div class="quickMenu">
    <div class="username-title text-center">
      <p>Welcome, <strong><?php echo e($data['user']->DisplayName); ?></strong></p>
      <span id="points"><strong><?php echo e($data['user']->Point); ?></strong> <?php echo e(SERVER['name']); ?> Points</span>
    </div>
    <div class="username-underline"></div>
    <?php separator(20) ?>
    <ul class="text-center">
      <?php if (\Illuminate\Support\Facades\Blade::check('adm')): ?>
        <li><a href="/admin" target="_blank">Admin Panel</a></li>
      <?php endif; ?>
      <li><a href="/user/panel">Account Panel</a></li>
      <li><a href="/user/donate">Donate</a></li>
      <li><a href="/user/vote">Vote for DP</a></li>
      <li><a href="/user/rewards">PvP Rewards</a></li>
      <li><a href="/game/webmall">Web Mall</a></li>
      <li><a href="/game/webmall/tieredSpender">Tiered Spender</a></li>
      <li><a href="/help/support">Support</a></li>
      <li>
        <form id="logout" method="post" action="/auth/logout">
          <a href="#" onclick="document.getElementById('logout').submit();"><?php echo e(__('logout')); ?></a>
        </form>
      </li>
    </ul>
  </div>
  
<?php endif; ?>
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
<?php /**PATH C:\laragon\www\ShaiyaCMS\app\widgets\quickMenu\php/script.blade.php ENDPATH**/ ?>