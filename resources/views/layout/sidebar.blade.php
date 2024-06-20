  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('home') }}" class="brand-link">
          <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
              class="brand-image img-circle elevation-3" style="opacity: .8">
          @php
              $user = auth()->user();
              $roles = ['Super-Admin', 'Doctor', 'Branch-Admin', 'Receptionist'];
          @endphp

          @foreach ($roles as $role)
              @if ($user->hasRole($role))
                  <span class="brand-text font-weight-light">HMS-{{ strtoupper($role) }}</span>
              @endif
          @endforeach


      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ asset('dist/img/profile-1.png') }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">
                      @if (Auth::check())
                          {{ Auth::user()->member->f_name }} {{ Auth::user()->member->l_name }}
                      @endif
                  </a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <li class="nav-header active" style="background: white; color: #343a40; font-weight: bold">Today is
                      {{ Carbon\Carbon::parse('today')->format('D m, Y') }}</li>
                  <li class="nav-header active">NAVIGATIONS</li>

                  {{-- //psttient area --}}
                  @if (Auth::user()->hasRole(['Super-Admin', 'Doctor', 'Receptionist', 'Branch-Admin']))
                      <li class="nav-item">
                          <a href="{{ route('home') }}" class="nav-link">
                              <i class="nav-icon fa fa-cog"></i>
                              <p>
                                  Dashboard
                                  {{-- <span class="right badge badge-danger">New</span> --}}
                              </p>
                          </a>
                      </li>
                  @endif
                  @auth
                      @can('Access-Pattient')
                          <li class="nav-item">
                              <a href="{{ route('pattientarea') }}" class="nav-link">
                                  <i class="nav-icon fas fa-th"></i>
                                  <p>
                                      Pattients Area
                                      {{-- <span class="right badge badge-danger">New</span> --}}
                                  </p>
                              </a>
                          </li>
                      @endcan
                  @endauth


                  @canany(['Create-Branch', 'View-Branch', 'Edit-Branch', 'Delete-Branch'])
                      {{-- @canany(['Create-Pattient', 'View-Pattient', 'Edit-Pattient', 'Delete-Pattient']) --}}
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
                  <li class="nav-item">
                      <a href="{{ route('profile') }}" class="nav-link">
                          <i class="nav-icon fas fa-address-book"></i>
                          <p>
                              Profile
                          </p>
                      </a>
                  </li>

                  @if (Auth::user()->hasRole('Super-Admin'))
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
                  @endif



              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
