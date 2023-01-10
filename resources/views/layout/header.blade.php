  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                {{-- <img src="" style="height: 20px; width: 20px;" alt="user-image"
                    class="img-size-50 mr-3 img-circle"> --}}
                    <span class="fa fa-user"></span>
                <span class="fas fa-caret-down"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <a href="#" class="dropdown-item">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Credentials
                                <span class="float-right text-sm text-green"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm text-muted"><i class="fas fa-key green"></i> Change Password</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{route('auth.logout')}}" class="dropdown-item" role="button">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Logout
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm text-muted"><i class="fas fa-power-off red"></i>Logout</p>
                        </div>
                    </div>
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
  </nav>
  <!-- /.navbar -->
