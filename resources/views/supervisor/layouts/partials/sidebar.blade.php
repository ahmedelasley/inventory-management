        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" >
          <div class="app-brand demo">
            @include('supervisor.layouts.partials.logo')
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
          <!-- User Info -->
          <div class="d-flex justify-content-evenly mt-5">
            <div class="flex-shrink-0 mx-3">
              <div class="avatar avatar-online">
                <img src="https://placehold.co/800x800/696cff/ffffff?font=roboto&text={{ getInitials(Auth::guard('supervisor')->user()->name) }}" alt class="w-px-40 h-auto rounded-circle" />
              </div>
            </div>
            <div class="flex-grow-1">
              <span class="fw-semibold d-block">{{ Auth::guard('supervisor')->user()->name }}</span>
              <small class="fw-semibold d-block">{{ Auth::guard('supervisor')->user()->email }}</small>
              <small class="text-primary">Kitchen Supervisor</small>
            </div>
          </div>
          <!-- User Info -->

          {{-- <div class="menu-inner-shadow"></div> --}}

          <ul class="menu-inner py-5">

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Dashboard</span>
            </li>
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
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Inventory</div>
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