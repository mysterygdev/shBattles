<div class="header-line-wrapper">
  <header class="header-wrapper fixed-top plr100">
    <div class="table height-100p">
      <div class="table-row">
        <div class="table-cell valign-middle text-left">
          <a href="/" class="logo">
            <img src="/resources/themes/core/images/logos/original-invisible.png" width="175" alt="" class="img-responsive inline-block">
          </a>
        </div>
        <div class="table-cell valign-top text-center vm-sm">
          <div class="main-menu">
            <span class="toggle_menu">
              <span></span>
            </span>
            <ul class="menu clearfix">
              <li class="inline-block active">
                <a href="/">
                  Home
                </a>
              </li>
              
              <li class="inline-block menu-item-has-children">
                <a href="#">
                  Server
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="/server/about">About</a>
                  </li>
                  <li>
                    <a href="/server/bossrecords">Boss Records</a>
                  </li>
                  <li>
                    <a href="/server/drops">Drops</a>
                  </li>
                  <li>
                    <a href="/server/download">Download</a>
                  </li>
                  <li>
                    <a href="/server/terms">Terms of Service</a>
                  </li>
                </ul>
              </li>
              <?php if (\Illuminate\Support\Facades\Blade::check('auth')): ?>
              <li class="inline-block menu-item-has-children">
                <a href="#">
                  Community
                </a>
                <ul class="sub-menu">
                
                  <li>
                    <a href="/community/patchnotes">Patch Notes</a>
                  </li>
                  <li>
                    <a href="/eventCalender">Event Calender</a>
                  </li>
                  <li>
                    <a href="/community/rankings">Rankings</a>
                  </li>
                  <li>
                    <a href="/community/guildrankings">Guild Rankings</a>
                  </li>
                </ul>
              </li>
              <li class="inline-block menu-item-has-children">
                <a href="/help/support">
                  Support
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="/help/support">Tickets</a>
                  </li>
                  <li>
                    <a href="/help/support">Find Ticket</a>
                  </li>
                </ul>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
        <div class="table-cell valign-top text-right">
          <div class="right-bl">
            <?php if (\Illuminate\Support\Facades\Blade::check('guest')): ?>
            <div class="search-wrapper inline-block valign-middle">
            <a href="/user/login" class="fa fa-user"></a>
            </div>
            <a href="/user/register" class="btn header-btn ml25 color-white hidden-sm hidden-xs">
              Sign up
            </a>
            <a href="/user/login" class="btn header-btn ml25 color-white hidden-sm hidden-xs">
              Log In
            </a>
            <?php else: ?>
              <div class="main-menu">
                <ul class="menu clearfix">
                  <li class="inline-block menu-item-has-children">
                    <a href="#">
                      <?php echo e($data['user']->DisplayName); ?> <i class="fa fa-user"></i>
                    </a>
                    <ul class="sub-menu">
                      <?php if (\Illuminate\Support\Facades\Blade::check('adm')): ?>
                        <li>
                          <a href="/admin" target="_blank">Admin Panel</a>
                        </li>
                      <?php endif; ?>
                      <li>
                        <a href="/userpanel">User Panel</a>
                      </li>
                      <li>
                        <a href="/donate">Donate</a>
                      </li>
                      
                      <li>
                        <a href="/rewards">PvP Rewards</a>
                      </li>
                      <li>
                        <a href="/webmall">Webmall</a>
                      </li>
                      <li>
                        <a href="/guildmall">Guildmall</a>
                      </li>
                      <li>
                      <a href="/webmall/tieredSpender">
                        <span>Tiered Spender</span>
                      </a>
                      </li>
                      <li>
                        <a href="/promotions">Promotions</a>
                      </li>
                      <li>
                        <form id="logout" method="post" action="/auth/logout">
                          <a href="#" onclick="document.getElementById('logout').submit();">Logout</a>
                        </form>
                      </li>
                    </ul>
                    <?php
                      $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
                      $isMob = is_numeric(strpos($ua, "mobile"));
                    ?>
                    <?php if(($isMob)==1): ?>
                    <ul class="menu clearfix">
              <li class="inline-block active">
                <a href="/">
                  Home
                </a>
              </li>
              <li class="inline-block">
                <a href="/community/downloads">
                  Download
                </a>
              </li>
              <li class="inline-block menu-item-has-children">
                <a href="#">
                  Server Info
                </a>
                <ul class="sub-menu">
                  <li>
                    <a href="/serverinfo/about">About</a>
                  </li>
                  <li>
                    <a href="/serverinfo/drops">Drops</a>
                  </li>
                  <li>
                    <a href="/serverinfo/terms">Terms of Service</a>
                  </li>
                </ul>
              </li>
              <?php if (\Illuminate\Support\Facades\Blade::check('auth')): ?>
              <li class="inline-block menu-item-has-children">
                <a href="#">
                  Community
                </a>
                <ul class="sub-menu">
                
                  <li>
                    <a href="/community/patchnotes">Patch Notes</a>
                  </li>
                  <li>
                    <a href="/eventCalender">Event Calender</a>
                  </li>
                  <li>
                    <a href="/community/rankings">Rankings</a>
                  </li>
                  <li>
                    <a href="/community/guildrankings">Guild Rankings</a>
                  </li>
                  <li>
                    <a href="/serverinfo/bossrecords">Boss Records</a>
                  </li>
                  <li>
                        <a href="/support">Support</a>
                  </li>
                </ul>
              </li>
              <li class="inline-block menu-item-has-children">
                <a href="#">
                  Extra
                </a>
                <ul class="sub-menu">
                      <?php if (\Illuminate\Support\Facades\Blade::check('adm')): ?>
                        <li>
                          <a href="/admin" target="_blank">Admin Panel</a>
                        </li>
                      <?php endif; ?>
                      <li>
                        <a href="/userpanel">User Panel</a>
                      </li>
                      <li>
                        <a href="/donate">Donate</a>
                      </li>
                      
                      <li>
                        <a href="/rewards">PvP Rewards</a>
                      </li>
                      <li>
                        <a href="/webmall">Webmall</a>
                      </li>
                      <li>
                        <a href="/guildmall">Guildmall</a>
                      </li>
                      <li>
                      <a href="/webmall/tieredSpender">
                        <span>Tiered Spender</span>
                      </a>
                      </li>
                      <li>
                        <a href="/promotions">Promotions</a>
                      </li>
                </ul>
              </li>
              <?php endif; ?>
            </ul>

                      <?php endif; ?>
                  </li>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </header>
</div>
<?php /**PATH C:\laragon\www\ShaiyaCMS\resources\views/partials/cms/nav.blade.php ENDPATH**/ ?>