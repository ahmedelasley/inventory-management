          <!-- Navbar -->

          <nav
            class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                {{-- <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li> --}}

                <!-- Languages -->
                <li class="nav-item navbar-dropdown dropdown-languages dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar d-flex">
                      <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/translate.png" alt class="w-px-40 h-auto me-2" />
                      
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                          <a class="dropdown-item d-flex" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{-- <i class="bx bx-user me-2"></i> --}}
                            <img class="me-2"src="https://unpkg.com/language-icons/icons/{{ $localeCode }}.svg" width="28">
                            <span class="align-middle">{{ $properties['native'] }}</span>
                          </a>
                        </li>
                    @endforeach
                  </ul>
                </li>
                <!--/ Languages -->

                <!-- Notifications -->
                <li class="nav-item navbar-dropdown dropdown-notification dropdown mx-3">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">

                      <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/bell.png" alt class=" h-auto rounded-circle" />
                      @if(Auth::guard('manager')->user()->unreadNotifications->count())
                      <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20" style="margin-left: -20px;">{{ Auth::guard('manager')->user()->unreadNotifications->count() }}</span>
                      @endif
                    </div>
                  </a>
                  @if(Auth::guard('manager')->user()->unreadNotifications->count())
                  <ul class="dropdown-menu dropdown-menu-end " style="width: 300px;">
                    <li class="mb-2 ">
                      <div class="dropdown-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Notifications</h5>
                        <a href="javascript:void(0)" class="text-danger"><i class='bx bxs-trash'></i></a>
                      </div>
                      <div class="dropdown-divider"></div>

                    </li>
                    <div style="width: 300px;height : calc(100vh - 700px);position: relative;overflow: auto;">
                      @foreach(Auth::guard('manager')->user()->unreadNotifications->take(5) as $notification)
                        <li class="dropdown-item p-2 my-0" >
                          <a class="" href="{{ route('manager.orders.create.order', ['order' => $notification->data['details']['order_id'], "notification_id" => $notification->id ] ) }}" >
                            {{-- <div class="avatar">
                                <i class='bx bxs-bell-ring'></i>
                              </div> --}}
                              <div class="d-flex justify-content-between">
                                <span class="fw-bold">{{ $notification->data['details']['title'] }}</span>
                                <small class="text-muted">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</small>
                              </div>
                              <p class="text-wrap text-muted">{{ Str::limit($notification->data['details']['body'], 30, '...' ) }}</p>
                          </a>
                        </li>
                        <div class="dropdown-divider"></div>
                      @endforeach
                    </div>
                    <div class="dropdown-divider"></div>
                    <li class="dropdown-item text-center">
                      <a class="" href="{{ route('manager.notifications.read.all')}}">Show All Notifications</a>
                    </li>                 
                  </ul>
                  @else
                  <ul class="dropdown-menu dropdown-menu-end " style="width: 300px;">
                    <li class="mb-2 ">
                      <div class="dropdown-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Notifications</h5>
                        <a href="javascript:void(0)" class="text-danger"><i class='bx bxs-trash'></i></a>
                      </div>
                      <div class="dropdown-divider"></div>
                      <li class="dropdown-item p-2 my-0" >
                        <div class="d-flex justify-content-center">
                          <span class="fw-bold">No New Notifications</span>
                        </div>
                      </li>
                      <div class="dropdown-divider"></div>
                    </li>
                  </ul>
                  @endif
                </li>
                <!--/ Notifications -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="https://placehold.co/800x800/696cff/ffffff?font=roboto&text={{ getInitials(Auth::guard('manager')->user()->name) }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="https://placehold.co/800x800/696cff/ffffff?font=roboto&text={{ getInitials(Auth::guard('manager')->user()->name) }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::guard('manager')->user()->name }}</span>
                            <small class="text-muted">Manager</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('manager.profile.index') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('manager.logout') }}">
                        @csrf
                        <a class="dropdown-item" href="{{route('manager.logout')}}"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                      </form>
                    </li>
                  </ul>
                </li>
                <!--/ User -->

                                
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->