        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" >
          <div class="app-brand demo">
            @include('admin.layouts.partials.logo')
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
          <!-- User Info -->
          <div class="d-flex justify-content-evenly mt-5">
            <div class="flex-shrink-0 mx-3">
              <div class="avatar avatar-online">
                <img src="https://placehold.co/800x800/696cff/ffffff?font=roboto&text={{ getInitials(Auth::guard('admin')->user()->name) }}" alt class="w-px-40 h-auto rounded-circle" />
              </div>
            </div>
            <div class="flex-grow-1">
              <span class="fw-semibold d-block text-wrap">{{ Auth::guard('admin')->user()->name }}</span>
              <!--<small class="fw-semibold d-block text-wrap " style="width: 100%;">{{ Auth::guard('admin')->user()->email }}</small>-->
              @php
              $email = Auth::guard('admin')->user()->email;
              @endphp
            <small class="fw-semibold d-block text-wrap " style="width: 100%;">{!! nl2br(strlen($email) > 20 && str_contains($email, '@') ? str_replace('@', "\n@", $email) : $email) !!}</small>

              <small class="text-primary">Administrate</small>
            </div>
          </div>
          <!-- User Info -->

          {{-- <div class="menu-inner-shadow"></div> --}}

          <ul class="menu-inner py-5">

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Dashboard</span>
            </li>

            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/dashboard.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Dashboard</div>
              </a>
            </li>
            @if(admin()->can('administration-list'))
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
                @if(admin()->can('administration-list'))
                <!-- Administrates -->
                <li class="menu-item {{ request()->routeIs(['admin.admins.index']) ? 'active' : '' }}">
                  <a href="{{ route('admin.admins.index') }}" class="menu-link">
                    <div data-i18n="Admins Roles">Administrates</div>
                  </a>
                </li>
                @endif
                @if(admin()->can('manager-list'))
                <!-- Normal Users -->
                <li class="menu-item  {{ request()->routeIs(['admin.managers.index']) ? 'active' : '' }}">
                  <a href="{{ route('admin.managers.index') }}" class="menu-link">
                    <div data-i18n="Managers Roles">Restaurant Manager</div>
                  </a>
                </li>
                @endif
                @if(admin()->can('supervisor-list'))
                <!-- Kitchen Supervisors -->
                <li class="menu-item  {{ request()->routeIs(['admin.supervisors.index']) ? 'active' : '' }}">
                  <a href="{{ route('admin.supervisors.index') }}" class="menu-link">
                    <div data-i18n="Supervisors Roles">Kitchen Supervisors</div>
                  </a>
                </li>
                @endif
                @if(admin()->can('keeper-list'))
                <!-- Warehouse Keepers -->
                <li class="menu-item  {{ request()->routeIs(['admin.keepers.index']) ? 'active' : '' }}">
                  <a href="{{ route('admin.keepers.index') }}" class="menu-link">
                    <div data-i18n="Keepers Roles">Warehouse Keepers</div>
                  </a>
                </li>
                @endif

                
              </ul>
            </li>
            @endif
            @if(admin()->can('administration-role-list'))


            <!-- Roles -->
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/roles.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Roles</div>
              </a>
              <ul class="menu-sub">
                @if(admin()->can('administration-role-list'))
                <li class="menu-item {{ request()->routeIs(['admin.admins-roles.*']) ? 'active' : '' }}">
                  <a href="{{ route('admin.admins-roles.index') }}" class="menu-link">
                    <div data-i18n="Admins Roles">Administrates Roles</div>
                  </a>
                </li>
                @endif
                @if(admin()->can('manager-role-list'))
                <li class="menu-item  {{ request()->routeIs(['admin.managers-roles.*']) ? 'active' : '' }}">
                  <a href="{{ route('admin.managers-roles.index') }}" class="menu-link">
                    <div data-i18n="Managers Roles">Restaurant Managers Roles</div>
                  </a>
                </li>
                @endif
                @if(admin()->can('supervisor-role-list'))
                <li class="menu-item  {{ request()->routeIs(['admin.supervisors-roles.*']) ? 'active' : '' }}">
                  <a href="{{ route('admin.supervisors-roles.index') }}" class="menu-link">
                    <div data-i18n="Supervisors Roles">Kitchen Supervisors Roles</div>
                  </a>
                </li>
                @endif
                @if(admin()->can('keeper-role-list'))
                <li class="menu-item  {{ request()->routeIs(['admin.keepers-roles.*']) ? 'active' : '' }}">
                  <a href="{{ route('admin.keepers-roles.index') }}" class="menu-link">
                    <div data-i18n="Keepers Roles">Warehouse Keepers Roles</div>
                  </a>
                </li>
                @endif

                
              </ul>
            </li>
            @endif

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Kitchens & Warehouses</span>
            </li>
            @if(admin()->can('restaurant-list'))
            <!-- Restaurants -->
            <li class="menu-item {{ request()->routeIs('admin.restaurants.index') ? 'active' : '' }}">
              <a href="{{ route('admin.restaurants.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/restaurant.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Restaurants</div>
              </a>
            </li>
            @endif
            @if(admin()->can('kitchen-list'))
            <!-- Kitchens -->
            <li class="menu-item {{ request()->routeIs('admin.kitchens.index') ? 'active' : '' }}">
              <a href="{{ route('admin.kitchens.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/kitchen.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Kitchens</div>
              </a>
            </li>
            @endif
            @if(admin()->can('warehouse-list'))
            <!-- Suppliers -->
            <li class="menu-item {{ request()->routeIs('admin.warehouses.index') ? 'active' : '' }}">
              <a href="{{ route('admin.warehouses.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/warehouse.png" alt="User" class="menu-icon tf-icons " />
                <div data-i18n="Analytics" class="fw-bolder">Warehouses</div>
              </a>
            </li>
            @endif
            @if(admin()->can('menu-list'))
            <!-- Menus -->
            <li class="menu-item {{ request()->routeIs('admin.menus.index') ? 'active' : '' }}">
              <a href="{{ route('admin.menus.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/menu.png" alt="User" class="menu-icon tf-icons " />
                <div data-i18n="Analytics" class="fw-bolder">Menus</div>
              </a>
            </li>
            @endif
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Suppliers & Products</span>
            </li>
            @if(admin()->can('supplier-list'))
            <!-- Suppliers -->
            <li class="menu-item {{ request()->routeIs('admin.suppliers.index') ? 'active' : '' }}">
              <a href="{{ route('admin.suppliers.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/supplier.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Suppliers</div>
              </a>
            </li>
            @endif
            @if(admin()->can('client-list'))
            <!-- Clients -->
            <li class="menu-item {{ request()->routeIs('admin.clients.index') ? 'active' : '' }}">
              <a href="{{ route('admin.clients.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/client.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Clients</div>
              </a>
            </li>
            @endif
            @if(admin()->can('category-list'))
            <!-- Categories -->
            <li class="menu-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
              <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/list.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Categories</div>
              </a>
            </li>
            @endif
            @if(admin()->can('product-list'))
            <!-- Products -->
            <li class="menu-item {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
              <a href="{{ route('admin.products.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Products</div>
              </a>
            </li>
            @endif
            @if(admin()->can('purchasing-list'))
            <!-- Purchases -->
            <li class="menu-item {{ request()->routeIs('admin.purchases.index') ? 'active' : '' }}">
              <a href="{{ route('admin.purchases.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/shopping-cart.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Purchases</div>
              </a>
            </li>
            @endif
            @if(admin()->can('transfer-list'))
            <!-- Transfers -->
            <li class="menu-item {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}">
              <a href="{{ route('admin.orders.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/transfer.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Transfers</div>
              </a>
            </li>
            @endif
            @if(admin()->can('sale-list'))
            <!-- Sales -->
            <li class="menu-item {{ request()->routeIs('admin.sales.index') ? 'active' : '' }}">
              <a href="{{ route('admin.sales.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/sales.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Sales</div>
              </a>
            </li>
            @endif
            @if(admin()->can('setting-list'))
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Settings</span>
            </li>
            @endif
            @if(admin()->can('setting-list'))
            <!-- Settings -->
            <li class="menu-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
              <a href="{{ route('admin.settings') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/settings.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Settings</div>
              </a>
            </li>
            @endif
          </ul>
        </aside>
        <!-- / Menu -->