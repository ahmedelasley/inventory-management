        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" >
          <div class="app-brand demo">
            @include('manager.layouts.partials.logo')
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
          <!-- User Info -->
          <div class="d-flex justify-content-evenly mt-5">
            <div class="flex-shrink-0 mx-3">
              <div class="avatar avatar-online">
                <img src="https://placehold.co/800x800/696cff/ffffff?font=roboto&text={{ getInitials(Auth::guard('manager')->user()->name) }}" alt class="w-px-40 h-auto rounded-circle" />
              </div>
            </div>
            <div class="flex-grow-1">
              <span class="fw-semibold d-block text-wrap">{{ Auth::guard('manager')->user()->name }}</span>
              <small class="fw-semibold d-block text-wrap">{{ Auth::guard('manager')->user()->email }}</small>
              <small class="text-primary">Manager</small>
            </div>
          </div>
          <!-- User Info -->

          {{-- <div class="menu-inner-shadow"></div> --}}

          <ul class="menu-inner py-5">

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Dashboard</span>
            </li>

            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('manager.dashboard') ? 'active' : '' }}">
              <a href="{{ route('manager.dashboard') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/dashboard.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Dashboard</div>
              </a>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Kitchens & Warehouses</span>
            </li>
            @if(manager()->can('restaurant-list'))
            <!-- Restaurants -->
            <li class="menu-item {{ request()->routeIs('manager.restaurants.index') ? 'active' : '' }}">
              <a href="{{ route('manager.restaurants.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/restaurant.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Restaurants</div>
              </a>
            </li>
            @endif
            @if(manager()->can('kitchen-list'))
            <!-- Kitchens -->
            <li class="menu-item {{ request()->routeIs('manager.kitchens.index') ? 'active' : '' }}">
              <a href="{{ route('manager.kitchens.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/kitchen.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Kitchens</div>
              </a>
            </li>
            @endif
            @if(manager()->can('warehouse-list'))
            <!-- Suppliers -->
            <li class="menu-item {{ request()->routeIs('manager.warehouses.index') ? 'active' : '' }}">
              <a href="{{ route('manager.warehouses.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/warehouse.png" alt="User" class="menu-icon tf-icons " />
                <div data-i18n="Analytics" class="fw-bolder">Warehouses</div>
              </a>
            </li>
            @endif
            @if(manager()->can('menu-list'))
            <!-- Menus -->
            <li class="menu-item {{ request()->routeIs('manager.menus.index') ? 'active' : '' }}">
              <a href="{{ route('manager.menus.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/menu.png" alt="User" class="menu-icon tf-icons " />
                <div data-i18n="Analytics" class="fw-bolder">Menus</div>
              </a>
            </li>
            @endif
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Suppliers & Products</span>
            </li>
            @if(manager()->can('supplier-list'))
            <!-- Suppliers -->
            <li class="menu-item {{ request()->routeIs('manager.suppliers.index') ? 'active' : '' }}">
              <a href="{{ route('manager.suppliers.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/supplier.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Suppliers</div>
              </a>
            </li>
            @endif
            @if(manager()->can('client-list'))
            <!-- Clients -->
            <li class="menu-item {{ request()->routeIs('manager.clients.index') ? 'active' : '' }}">
              <a href="{{ route('manager.clients.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/client.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Clients</div>
              </a>
            </li>
            @endif
            @if(manager()->can('category-list'))
            <!-- Categories -->
            <li class="menu-item {{ request()->routeIs('manager.categories.index') ? 'active' : '' }}">
              <a href="{{ route('manager.categories.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/list.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Categories</div>
              </a>
            </li>
            @endif
            @if(manager()->can('product-list'))
            <!-- Products -->
            <li class="menu-item {{ request()->routeIs('manager.products.index') ? 'active' : '' }}">
              <a href="{{ route('manager.products.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Products</div>
              </a>
            </li>
            @endif
            @if(manager()->can('purchasing-list'))
            <!-- Purchases -->
            <li class="menu-item {{ request()->routeIs('manager.purchases.index') ? 'active' : '' }}">
              <a href="{{ route('manager.purchases.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/shopping-cart.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Purchases</div>
              </a>
            </li>
            @endif
            @if(manager()->can('transfer-list'))
            <!-- Transfers -->
            <li class="menu-item {{ request()->routeIs('manager.orders.index') ? 'active' : '' }}">
              <a href="{{ route('manager.orders.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/transfer.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Transfers</div>
              </a>
            </li>
            @endif
            @if(manager()->can('sale-list'))
            <!-- Sales -->
            <li class="menu-item {{ request()->routeIs('manager.sales.index') ? 'active' : '' }}">
              <a href="{{ route('manager.sales.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/sales.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Sales</div>
              </a>
            </li>
            @endif
            @if(manager()->can('setting-list'))
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Settings</span>
            </li>
            @endif
            @if(manager()->can('setting-list'))
            <!-- Settings -->
            <li class="menu-item {{ request()->routeIs('manager.settings') ? 'active' : '' }}">
              <a href="{{ route('manager.settings') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/settings.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Settings</div>
              </a>
            </li>
            @endif
          </ul>
        </aside>
        <!-- / Menu -->