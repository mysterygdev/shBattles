<nav class="navbar-youplay navbar navbar-default navbar-fixed-top ">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="off-canvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="/">
          <img src="/resources/themes/YouPlay/images/logos/battles.png" alt="">
        </a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown dropdown-hover ">
            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Server <span class="caret"></span> <span class="label">e.x drop list</span>
                    </a>
            <div class="dropdown-menu">
              <ul role="menu">
                <li><a href="/server/about">About</a>
                </li>
                <li><a href="/server/bossrecords/">Boss Records</a>
                </li>
                <li><a href="/server/drops">Drops</a>
                </li>
              </ul>
              <ul role="menu">
                <li><a href="/download">Download</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="dropdown dropdown-hover ">
            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Community <span class="caret"></span> <span class="label">e.x rankings</span>
                    </a>
            <div class="dropdown-menu">
              <ul role="menu">
                <li><a href="/community/patchnotes/">Patch Notes</a>
                </li>
                <li><a href="/community/events/">Events</a>
                </li>
                <li><a href="/community/rankings">Rankings</a>
                </li>
              </ul>
              <ul role="menu">
                <li><a href="/community/guildrankings">Guild Rankings</a>
                </li>
                <li><a href="/community/polls">Polls</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="dropdown dropdown-hover ">
            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Help <span class="caret"></span> <span class="label">e.x support</span>
                    </a>
            <div class="dropdown-menu">
              <ul role="menu">
                <li><a href="/help/rules">Rules</a>
                </li>
                <li><a href="/help/support">Support</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown dropdown-hover">
            <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
              <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                Guest <span class="caret"></span> <span class="label">Welcome</span>
              </a>
              <div class="dropdown-menu">
                <ul role="menu">
                  <li>
                    <a href="/user/register">Register</a>
                  </li>
                  <li>
                    <a href="/user/login">Login</a>
                  </li>
                  </li>
                </ul>
              </div>
            <?php else: ?>
              <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                <?php echo e($data['user']->DisplayName); ?> <span class="caret"></span> <span class="label">Welcome</span>
              </a>
              <div class="dropdown-menu">
                <ul role="menu">
                  <?php if (\Illuminate\Support\Facades\Blade::check('adm')): ?>
                    <li>
                      <a href="/admin" target="_blank">Admin Panel</a>
                    </li>
                  <?php endif; ?>
                  <li>
                    <a href="/user/panel">User Panel</a>
                  </li>
                  <li>
                    <a href="/user/donate">Donation</a>
                  </li>
                  <li>
                    <a href="/game/vote">Vote For DP</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <a href="/game/rewards">PvP Rewards</a>
                  </li>
                  <li>
                    <a href="/game/webmall">Webmall</a>
                  </li>
                  <li>
                    <a href="/game/webmall/tieredSpender">Tiered Spender</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <a href="/help/support">Support</a>
                  </li>
                  <li>
                    <a href="/auth/logout">Logout</a>
                  </li>
                  </li>
                </ul>
                <ul role="menu">
                  <li><a href="/user/shareDp">Share DP</a>
                  </li>
                  <li><a href="/user/shareDp">GRB Rewards</a>
                  </li>
                  <li><a href="/user/move2Terra">Move to Terra</a>
                  </li>
                </ul>
              </div>
            <?php endif; ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<?php /**PATH C:\laragon\www\shaiyabattles\resources\views/partials/cms/nav.blade.php ENDPATH**/ ?>