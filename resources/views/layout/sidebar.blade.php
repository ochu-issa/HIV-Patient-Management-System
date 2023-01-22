  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
              style="opacity: .8">
          @auth
              @hasrole('Super-Admin')
                  <span class="brand-text font-weight-light">HMS-SUPER-</span>
              @else
                  @hasrole('Doctor')
                      <span class="brand-text font-weight-light">HMS-DOCTOR</span>
                  @else
                      @hasrole('Branch-Admin')
                          <span class="brand-text font-weight-light">HMS-BRANCH-ADMIN</span>
                      @else
                          @hasrole('Receptionist')
                              <span class="brand-text font-weight-light">HMS-RECEPTIONIST</span>
                          @else
                              <span class="brand-text font-weight-light">HMS-USER</span>
                          @endhasrole
                      @endhasrole
                  @endhasrole
              @endhasrole
          @endauth


      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block"> {{ Auth::user()->member_id }}</a>
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

                  {{-- //psttient area --}}
                  @can('Access-Pattient')
                      <li class="nav-item">
                          <a href="{{ route('pattientarea') }}" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  Pattients Area
                                  <span class="right badge badge-danger">New</span>
                              </p>
                          </a>
                      </li>
                  @endcan

                  @canany(['Create-Branch', 'View-Branch', 'Edit-Branch', 'Delete-Branch'])
                      <li class="nav-item">
                          <a href="{{ route('branches') }}" class="nav-link">
                              <i class="nav-icon fas fa-hospital"></i>
                              <p>
                                  Branches
                              </p>
                          </a>
                      </li>
                  @endcanany

                  <li class="nav-item menu-close ">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa fa-users"></i>
                          <p>
                              Manage Users
                              <i class="right fas fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          @canany(['Create-Pattient', 'View-Pattient', 'Edit-Pattient', 'Delete-Pattient'])

                              <li class="nav-item">
                                  <a href="{{ route('pattient') }}" class="nav-link">
                                      <i class="nav-icon far fas fa-procedures"></i>
                                      <p> Pattients</p>
                                  </a>
                              </li>
                          @endcanany

                          @canany(['Create-Receptionist', 'View-Receptionist', 'Edit-Receptionist',
                              'Delete-Receptionist'])
                              <li class="nav-item">
                                  <a href="{{ route('receptionist') }}" class="nav-link">
                                      <i class="nav-icon fa fa-user-nurse"></i></i>
                                      <p> Receptionist</p>
                                  </a>
                              </li>
                          @endcanany

                          @canany(['Create-Doctor', 'View-Doctor', 'Edit-Doctor', 'Delete-Doctor'])
                              <li class="nav-item">
                                  <a href="{{ route('doctor') }}" class="nav-link">
                                      <i class="nav-icon far fa fa-user-md"></i>
                                      <p> Doctors</p>
                                  </a>
                              </li>
                          @endcanany

                          @canany(['Create-Branch-Admin', 'View-Branch-Admin', 'Edit-Branch-Admin',
                              'Delete-Branch-Admin'])
                              <li class="nav-item">
                                  <a href="{{ route('branchadmin') }}" class="nav-link">
                                      <i class="nav-icon far fas fa-id-card-alt"></i>
                                      <p> Branch Admin</p>
                                  </a>
                              </li>
                          @endcanany
                      </ul>
                  </li>

                  @can('Setting')
                      <li class="nav-item">
                          <a href="{{ route('setting') }}" class="nav-link">
                              <i class="nav-icon fas fa-cog"></i>
                              <p>
                                  Settings
                              </p>
                          </a>
                      </li>
                  @endcan

                  <li class="nav-item">
                      <a href="{{ route('testing') }}" class="nav-link">
                          <i class="nav-icon fas fa-hospital"></i>
                          <p>
                              Testing
                          </p>
                      </a>
                  </li>

              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
