<header class="main-header">
  <a href="{{ route('/') }}" class="logo">
    <span class="logo-mini"><b>SPK</b></span>
    <span class="logo-lg"><b>SiPeKa</b> Application</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <company-title name="{{ companyName() }}"></company-title>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ active_avatar() }}" class="user-image" alt="{{ Auth::user()->username }}">
            <span class="hidden-xs">{{ Auth::user()->username }}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="{{ active_avatar() }}" class="img-circle" alt="{{ Auth::user()->username }}">
              <p>
                {{ Auth::user()->username.' - '. level(Auth::user()->level)}}
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a onclick="profile()" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a onclick="logout()" class="btn btn-default btn-flat">Logout</a>
                <form id="logout" action="{{ route('logout') }}" method="post">
                  {{ csrf_field() }}
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>