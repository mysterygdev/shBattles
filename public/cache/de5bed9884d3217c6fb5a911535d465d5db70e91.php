<nav class="navbar navbar-inverse navbar-custom navbar-fixed-top">
  <div class="container">
    <div class="navbar navbar-header">
      <a class="navbar-brand navbar-logo" href="/"></a>
      <button type="button" class="navbar-toggle custom-toggle-btn" data-toggle="collapse" data-target="#main-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="main-nav">
      <ul class="nav navbar-nav navbar-left">
        <li class="plain-link"><a href="/">Home</a></li>
        <li class="plain-link"><a href="/download">Download</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Server <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/server/about">About</a></li>
            <li><a href="/server/bossrecords">Boss Records</a></li>
            <li><a href="/server/drops">Drop List</a></li>
            <li><a href="/server/terms">Terms of Service</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Community <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/community/discord/">Discord</a></li>
            <li><a href="/community/news/">News</a></li>
            <li><a href="/community/patchnotes/">Patch Notes</a></li>
            <li><a href="/community/rankings/">PvP Rankings</a></li>
            <li><a href="/community/guildrankings/">Guild Rankings</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
          <?php echo e(display('register_form_modal','<i class="fas fa-user-plus"></i>','0','2','Registration Form')); ?>

          <?php echo e(display('login_form_modal','<i class="fas fa-sign-in-alt"></i>','0','2','Login Form')); ?>

          <?php echo e(display('logout_form_modal','<i class="fas fa-sign-in-alt"></i>','0','2','Logout Form')); ?>

          <li class="plain-link"><a href="#" class="open_register_form_modal" title="Register" data-id="" data-target="#register_form_modal" data-toggle="modal"><i class="fas fa-user-plus"></i> Register</a></li>
          <li class="plain-link"><a href="#" class="open_login_form_modal" title="Login" data-id="" data-target="#login_form_modal" data-toggle="modal"><i class="fas fa-sign-in-alt"></i> Login</a></li>
        <?php else: ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo e($data['user']->DisplayName); ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php if (\Illuminate\Support\Facades\Blade::check('adm')): ?>
                <li><a href="/admin" target="_blank">Admin Panel</a></li>
              <?php endif; ?>
              <li><a href="/user/panel">User Panel</a></li>
              <li><a href="/game/rewards">PvP Rewards</a></li>
              <li><a href="/game/webmall">Webmall</a></li>
              <li><a href="/game/webmall/tieredSpender">Tiered Spender</a></li>
              <li><a href="/game/vote">Vote</a></li>
              <li><a href="/auth/logout">Logout</a></li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<?php /**PATH C:\laragon\www\originals\resources\views/partials/cms/nav.blade.php ENDPATH**/ ?>