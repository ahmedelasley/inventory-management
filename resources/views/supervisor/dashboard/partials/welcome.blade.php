<div class="col-lg-5 mb-4 order-0">
    <div class="card bg-primary">
      <div class="d-flex align-items-end row">
        <div class="col-sm-8">
          <div class="card-body">
            <h4 class="card-title text-white">Welcome <b>{{ Auth::guard('supervisor')->user()->name }}</b> 🎉 in Panel</h4>
            <p class="mb-2 text-white">You have control over your  <b>{{ Auth::guard('supervisor')->user()->kitchen?->name }}</b></p>
            <form method="POST" action="{{ route('supervisor.logout') }}">
              @csrf
              <a class="btn btn-sm btn-danger" href="{{route('supervisor.logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                  <i class="bx bx-power-off"></i>
                  <span class="align-middle">Sign Out</span>
              </a>
          </form>
          </div>
        </div>
        <div class="col-sm-4 text-center text-sm-left">
          <div class="card-body pb-0">
            <img
              src="{{ URL::asset('assets/admin') }}/img/illustrations/man-with-kitchen-light.png"
              height="140"
              alt="View Badge User"
              data-app-dark-img="illustrations/man-with-laptop-dark.png"
              data-app-light-img="illustrations/man-with-laptop-light.png"
            />
          </div>
        </div>
      </div>
    </div>
  </div>