<li class="nav-item navbar-dropdown dropdown-notification dropdown mx-3" >
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
      <div class="avatar avatar-online">

        <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/bell.png" alt class=" h-auto rounded-circle" />
        @if(Auth::guard('supervisor')->user()->unreadNotifications->count())
        <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20" style="margin-left: -20px;">{{ Auth::guard('supervisor')->user()->unreadNotifications->count() }}</span>
        @endif
      </div>
    </a>
    @if(Auth::guard('supervisor')->user()->unreadNotifications->count())
    <ul class="dropdown-menu dropdown-menu-end " style="width: 300px;">
      <li class="mb-2 ">
        <div class="dropdown-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Notifications</h5>
          <a href="{{ route('supervisor.notifications.read.all') }}" class="text-primary"><i class='bx bxs-show'></i></a>
        </div>
        <div class="dropdown-divider"></div>

      </li>
      <div style="width: 300px;height : calc(100vh - 700px);position: relative;overflow: auto;">
        @foreach(Auth::guard('supervisor')->user()->unreadNotifications->take(5) as $notification)
          <li class="dropdown-item p-2 my-0" >
            <a class="" href="{{ route('supervisor.orders.create.order', ['order' => $notification->data['details']['order_id'], "notification_id" => $notification->id ] ) }}" >
              {{-- <div class="avatar">
                  <i class='bx bxs-bell-ring'></i>
                </div> --}}
                <div class="d-flex justify-content-between">
                  <span class="fw-bold">{{ Str::limit($notification->data['details']['title'], 25, '...' ) }}</span>
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
        <a class="" href="{{ route('supervisor.notifications.index') }}">Show All Notifications</a>
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