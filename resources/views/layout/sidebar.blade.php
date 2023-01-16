  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          <span class="brand-text font-weight-light">HMS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"> {{ Auth::user()->name }}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-header active">NAVIGATION</li>
                  <li class="nav-item menu-close ">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-users"></i>
                          <p>
                              Manage Users
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('pattient') }}" class="nav-link">
                                  <i class="nav-icon far fas fa-procedures"></i>
                                  <p> Pattients</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('doctor') }}" class="nav-link">
                                  <i class="nav-icon far fa fa-user-md"></i>
                                  <p> Doctors</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('receptionist') }}" class="nav-link">
                                  <i class="nav-icon fa fa-user-nurse"></i></i>
                                  <p> Receptionist</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('branchadmin') }}" class="nav-link">
                                  <i class="nav-icon far fas fa-id-card-alt"></i>
                                  <p> Branch Admin</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  {{-- //psttient area --}}
                  <li class="nav-item">
                      <a href="{{ route('pattientarea') }}" class="nav-link">
                          <i class="nav-icon fas fa-th"></i>
                          <p>
                              Pattients Area
                              <span class="right badge badge-danger">New</span>
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ route('branches') }}" class="nav-link">
                          <i class="nav-icon fas fa-hospital"></i>
                          <p>
                              Branches
                          </p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('testing') }}" class="nav-link">
                        <i class="nav-icon fas fa-hospital"></i>
                        <p>
                            Testing
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('setting') }}" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
