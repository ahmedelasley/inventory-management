        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">

            @include('keeper.layouts.partials.logo')
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Dashboard</span>
          </li>
          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('keeper.dashboard') ? 'active' : '' }}">
              <a href="{{ route('keeper.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>


            <!-- Purchases -->
            <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bxs-user-circle"></i>
              <div data-i18n="Admins">Purchases</div>
            </a>
            <ul class="menu-sub">

              <!-- Administrates -->
              <li class="menu-item {{ request()->routeIs(['keeper']) ? 'active' : '' }}">
                <a href="{{ route('keeper.dashboard') }}" class="menu-link">
                  {{-- <i class="menu-icon tf-icons bx bxs-user-detail"></i> --}}
                  <div data-i18n="Admins Roles">Administrates</div>
                </a>
              </li>


              
            </ul>
          </li>


          <!-- Inventory -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bxs-user-circle"></i>
              <div data-i18n="Admins">Inventory</div>
            </a>
            <ul class="menu-sub">

              <!-- Administrates -->
              <li class="menu-item {{ request()->routeIs(['keeper']) ? 'active' : '' }}">
                <a href="{{ route('keeper.dashboard') }}" class="menu-link">
                  {{-- <i class="menu-icon tf-icons bx bxs-user-detail"></i> --}}
                  <div data-i18n="Admins Roles">Administrates</div>
                </a>
              </li>


              
            </ul>
          </li>



          <!-- Orders -->
          <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bxs-user-circle"></i>
              <div data-i18n="Admins">Orders</div>
            </a>
            <ul class="menu-sub">

              <!-- Administrates -->
              <li class="menu-item {{ request()->routeIs(['keeper']) ? 'active' : '' }}">
                <a href="{{ route('keeper.dashboard') }}" class="menu-link">
                  {{-- <i class="menu-icon tf-icons bx bxs-user-detail"></i> --}}
                  <div data-i18n="Admins Roles">Administrates</div>
                </a>
              </li>


              
            </ul>
          </li>



            
            
          </ul>
        </aside>
        <!-- / Menu -->