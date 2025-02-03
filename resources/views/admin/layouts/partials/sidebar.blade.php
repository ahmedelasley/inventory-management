        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" >
          <div class="app-brand demo shadow-sm">
            @include('admin.layouts.partials.logo')
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <!-- User Info -->
          <div class="d-flex justify-content-evenly mt-5">
            <div class="flex-shrink-0 mx-3">
              <div class="avatar avatar-online">
                <img src="https://placehold.co/800x800/696cff/ffffff?font=roboto&text={{ getInitials(Auth::guard('admin')->user()->name) }}" alt class="w-px-40 h-auto rounded-circle" />
              </div>
            </div>
            <div class="flex-grow-1">
              <span class="fw-semibold d-block">{{ Auth::guard('admin')->user()->name }}</span>
              <small class="fw-semibold d-block">{{ Auth::guard('admin')->user()->email }}</small>
              <small class="text-primary">Administrate</small>
            </div>
          </div>
          <!-- User Info -->

          <div class="menu-inner-shadow"></div>
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Dashboard</span>
          </li>
          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/dashboard.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Dashboard</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Users & Roles-Permissions</span>
            </li>

            <!-- Users -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/users.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Users</div>
              </a>
              <ul class="menu-sub">

                <!-- Administrates -->
                <li class="menu-item {{ request()->routeIs(['admin.admins.index']) ? 'active' : '' }}">
                  <a href="{{ route('admin.admins.index') }}" class="menu-link">
                    <div data-i18n="Admins Roles">Administrates</div>
                  </a>
                </li>

                <!-- Kitchen Supervisors -->
                <li class="menu-item  {{ request()->routeIs(['admin.supervisors.index']) ? 'active' : '' }}">
                  <a href="{{ route('admin.supervisors.index') }}" class="menu-link">
                    <div data-i18n="Supervisors Roles">Kitchen Supervisors</div>
                  </a>
                </li>

                <!-- Warehouse Keepers -->
                <li class="menu-item  {{ request()->routeIs(['admin.keepers.index']) ? 'active' : '' }}">
                  <a href="{{ route('admin.keepers.index') }}" class="menu-link">
                    <div data-i18n="Keepers Roles">Warehouse Keepers</div>
                  </a>
                </li>

                <!-- Normal Users -->
                <li class="menu-item  {{ request()->routeIs(['admin.users-roles.index']) ? 'active' : '' }}">
                  <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <div data-i18n="Users Roles">Restaurant Manager</div>
                  </a>
                </li>
                
              </ul>
            </li>



            <!-- Roles -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/roles.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Roles</div>
              </a>
              <ul class="menu-sub">

                <li class="menu-item {{ request()->routeIs(['admin.admins-roles.*']) ? 'active' : '' }}">
                  <a href="{{ route('admin.admins-roles.index') }}" class="menu-link">
                    <div data-i18n="Admins Roles">Administrates Roles</div>
                  </a>
                </li>

                <li class="menu-item  {{ request()->routeIs(['admin.supervisors-roles.*']) ? 'active' : '' }}">
                  <a href="{{ route('admin.supervisors-roles.index') }}" class="menu-link">
                    <div data-i18n="Supervisors Roles">Kitchen Supervisors Roles</div>
                  </a>
                </li>

                <li class="menu-item  {{ request()->routeIs(['admin.keepers-roles.*']) ? 'active' : '' }}">
                  <a href="{{ route('admin.keepers-roles.index') }}" class="menu-link">
                    <div data-i18n="Keepers Roles">Warehouse Keepers Roles</div>
                  </a>
                </li>

                <li class="menu-item  {{ request()->routeIs(['admin.users-roles.*']) ? 'active' : '' }}">
                  <a href="{{ route('admin.users-roles.index') }}" class="menu-link">
                    <div data-i18n="Users Roles">Restaurant Managers Roles</div>
                  </a>
                </li>
                
              </ul>
            </li>
            
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Kitchens & Warehouses</span>
            </li>

            <!-- Restaurants -->
            <li class="menu-item {{ request()->routeIs('admin.restaurants.index') ? 'active' : '' }}">
              <a href="{{ route('admin.restaurants.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/restaurant.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Restaurants</div>
              </a>
            </li>

            <!-- Kitchens -->
            <li class="menu-item {{ request()->routeIs('admin.kitchens.index') ? 'active' : '' }}">
              <a href="{{ route('admin.kitchens.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/kitchen.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Kitchens</div>
              </a>
            </li>

            <!-- Suppliers -->
            <li class="menu-item {{ request()->routeIs('admin.warehouses.index') ? 'active' : '' }}">
              <a href="{{ route('admin.warehouses.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/warehouse.png" alt="User" class="menu-icon tf-icons " />
                <div data-i18n="Analytics" class="fw-bolder">Warehouses</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Suppliers & Products</span>
            </li>

            <!-- Suppliers -->
            <li class="menu-item {{ request()->routeIs('admin.suppliers.index') ? 'active' : '' }}">
              <a href="{{ route('admin.suppliers.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/supplier.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Suppliers</div>
              </a>
            </li>

            <!-- Categories -->
            <li class="menu-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
              <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/list.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Categories</div>
              </a>
            </li>

            <!-- Products -->
            <li class="menu-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
              <a href="{{ route('admin.products.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Products</div>
              </a>
            </li>

            <!-- Purchases -->
            <li class="menu-item {{ request()->routeIs('admin.purchases.index') ? 'active' : '' }}">
              <a href="{{ route('admin.purchases.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/shopping-cart.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Purchases</div>
              </a>
            </li>

            <!-- Transfers -->
            <li class="menu-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
              <a href="{{ route('admin.orders.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/transfer.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Transfers</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Settings</span>
            </li>

            <!-- Settings -->
            <li class="menu-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
              <a href="{{ route('admin.settings') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/settings.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Settings</div>
              </a>
            </li>

          </ul>
        </aside>
        <!-- / Menu -->