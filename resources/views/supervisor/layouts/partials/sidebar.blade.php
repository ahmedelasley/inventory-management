        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">

            @include('supervisor.layouts.partials.logo')
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
            <li class="menu-item {{ request()->routeIs('supervisor.dashboard') ? 'active' : '' }}">
              <a href="{{ route('supervisor.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>

            <!-- Kitchens -->
            <li class="menu-item {{ request()->routeIs('supervisor.kitchens.index') ? 'active' : '' }}">
              <a href="{{ route('supervisor.kitchens.index') }}" class="menu-link">
                {{-- <i class='bx bxs-dish'></i> --}}
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/kitchen.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics">Kitchen Stock</div>
              </a>
            </li>
            
            <!-- Transfers -->
            <li class="menu-item {{ request()->routeIs('supervisor.orders.index') ? 'active' : '' }}">
              <a href="{{ route('supervisor.orders.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-transfer'></i>
                <div data-i18n="Analytics">Transfers</div>
              </a>
            </li>








            
            
          </ul>
        </aside>
        <!-- / Menu -->