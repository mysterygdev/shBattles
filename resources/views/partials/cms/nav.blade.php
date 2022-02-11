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
                <li><a href="/help/terms">Terms of Service</a>
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
              </ul>
            </div>
          </li>
          <li class="dropdown dropdown-hover ">
            <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      Features <span class="caret"></span> <span class="label">full list</span>
                    </a>
            <div class="dropdown-menu">
              <ul role="menu">
                <li class="dropdown dropdown-submenu pull-left ">
                  <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">User</a>
                  <div class="dropdown-menu">
                    <ul role="menu">
                      <li><a href="user-activity.html">Activity</a>
                      </li>
                      <li><a href="user-profile.html">Profile</a>
                      </li>
                      <li><a href="user-messages.html">Messages</a>
                      </li>
                      <li><a href="user-messages-compose.html">Messages Compose</a>
                      </li>
                      <li><a href="user-settings.html">Settings</a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li><a href="forums.html">Forums</a>
                </li>
                <li><a href="forums-topics.html">Forums Topics</a>
                </li>
                <li><a href="forums-single-topic.html">Single Topic</a>
                </li>
                <li><a href="matches-list.html">Matches List</a>
                </li>
                <li><a href="match.html">Match</a>
                </li>
                <li><a href="match-2.html">Match with Maps</a>
                </li>
              </ul>
              <ul role="menu">
                <li><a href="widgets.html">Widgets <span class="badge bg-default">New</span></a>
                </li>
                <li><a href="components.html">Components</a>
                </li>
                <li><a href="coming-soon.html">Coming Soon</a>
                </li>
                <li><a href="contact.html">Contact Us</a>
                </li>
                <li><a href="search.html">Search</a>
                </li>
                <li><a href="login.html">Login</a>
                </li>
                <li><a href="404.html">404</a>
                </li>
                <li><a href="blank.html">Blank</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown dropdown-hover">
            @guest
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
            @else
              <a href="#!" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                {{$data['user']->DisplayName}} <span class="caret"></span> <span class="label">Welcome</span>
              </a>
              <div class="dropdown-menu">
                <ul role="menu">
                  @adm
                    <li>
                      <a href="#">Admin Panel</a>
                    </li>
                  @endadm
                  <li>
                    <a href="#">User Panel</a>
                  </li>
                  <li>
                    <a href="#">Donation</a>
                  </li>
                  <li>
                    <a href="#">Vote For DP</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <a href="#">PvP Rewards</a>
                  </li>
                  <li>
                    <a href="#">Webmall</a>
                  </li>
                  <li>
                    <a href="#">Tiered Spender</a>
                  </li>
                  <li class="divider"></li>
                  <li>
                    <a href="#">Support</a>
                  </li>
                  <li>
                    <a href="/auth/logout">Logout</a>
                  </li>
                  </li>
                </ul>
              </div>
            @endguest
          </li>
        </ul>
      </div>
    </div>
  </nav>
