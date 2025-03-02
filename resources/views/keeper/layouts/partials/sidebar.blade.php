        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" >
          <div class="app-brand demo">
            @include('keeper.layouts.partials.logo')
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>
          <div class="menu-inner-shadow"></div>
          <!-- User Info -->
          <div class="d-flex justify-content-evenly mt-5">
            <div class="flex-shrink-0 mx-3">
              <div class="avatar avatar-online">
                <img src="https://placehold.co/800x800/696cff/ffffff?font=roboto&text={{ getInitials(Auth::guard('keeper')->user()->name) }}" alt class="w-px-40 h-auto rounded-circle" />
              </div>
            </div>
            <div class="flex-grow-1">
              <span class="fw-semibold d-block">{{ Auth::guard('keeper')->user()->name }}</span>
              <small class="fw-semibold d-block">{{ Auth::guard('keeper')->user()->email }}</small>
              <small class="text-primary">Warehouse Keeper</small>
            </div>
          </div>
          <!-- User Info -->

          {{-- <div class="menu-inner-shadow"></div> --}}

          <ul class="menu-inner py-5">

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Dashboard</span>
            </li>

            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('keeper.dashboard') ? 'active' : '' }}">
              <a href="{{ route('keeper.dashboard') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/dashboard.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Dashboard</div>
              </a>
            </li>
            {{-- @if(keeper()->can('supplier-list')) --}}
            <!-- Suppliers -->
            <li class="menu-item {{ request()->routeIs('keeper.suppliers.index') ? 'active' : '' }}">
              <a href="{{ route('keeper.suppliers.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/supplier.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Suppliers</div>
              </a>
            </li>
            {{-- @endif --}}
            {{-- @if(keeper()->can('category-list')) --}}
            <!-- Categories -->
            <li class="menu-item {{ request()->routeIs('keeper.categories.index') ? 'active' : '' }}">
              <a href="{{ route('keeper.categories.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/list.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Categories</div>
              </a>
            </li>
            {{-- @endif --}}
            {{-- @if(keeper()->can('product-list')) --}}
            <!-- Products -->
            <li class="menu-item {{ request()->routeIs('keeper.products.index') ? 'active' : '' }}">
              <a href="{{ route('keeper.products.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Products</div>
              </a>
            </li>
            {{-- @endif --}}
            <!-- Inventory -->
            <li class="menu-item {{ request()->routeIs('keeper.warehouses.index') ? 'active' : '' }}">
              <a href="{{ route('keeper.warehouses.index') }}" class="menu-link">
                {{-- <i class='bx bxs-dish'></i> --}}
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Inventory</div>
              </a>
            </li>
            
              <!-- Purchases -->
              <li class="menu-item {{ request()->routeIs('keeper.purchases.index') ? 'active' : '' }}">
                <a href="{{ route('keeper.purchases.index') }}" class="menu-link">
                  <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/shopping-cart.png" alt="User" class="menu-icon tf-icons" />
                  <div data-i18n="Analytics" class="fw-bolder">Purchases</div>
                </a>
              </li>
              
            <!-- Transfers -->
            <li class="menu-item {{ request()->routeIs('keeper.orders.index') ? 'active' : '' }}">
              <a href="{{ route('keeper.orders.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/transfer.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Transfers</div>
              </a>
            </li>

            <!-- Report -->
            <li class="menu-item {{ request()->routeIs('keeper.reports.index') ? 'active' : '' }}">
              <a href="{{ route('keeper.reports.index') }}" class="menu-link">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/report.png" alt="User" class="menu-icon tf-icons" />
                <div data-i18n="Analytics" class="fw-bolder">Reports</div>
              </a>
            </li>








            
            
          </ul>
        </aside>
        <!-- / Menu -->