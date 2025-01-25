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
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/dashboard.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Dashboard</div>
              </a>
            </li>

            <!-- Kitchens -->
            <li class="menu-item {{ request()->routeIs('supervisor.kitchens.index') ? 'active' : '' }}">
              <a href="{{ route('supervisor.kitchens.index') }}" class="menu-link">
                {{-- <i class='bx bxs-dish'></i> --}}
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/kitchen.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Kitchen Stock</div>
              </a>
            </li>
            
            <!-- Transfers -->
            <li class="menu-item {{ request()->routeIs('supervisor.orders.index') ? 'active' : '' }}">
              <a href="{{ route('supervisor.orders.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/transfer.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Transfers</div>
              </a>
            </li>

            <!-- Report -->
            <li class="menu-item {{ request()->routeIs('supervisor.reports.index') ? 'active' : '' }}">
              <a href="{{ route('supervisor.reports.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/report.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Reports</div>
              </a>
            </li>








            
            
          </ul>
        </aside>
        <!-- / Menu -->