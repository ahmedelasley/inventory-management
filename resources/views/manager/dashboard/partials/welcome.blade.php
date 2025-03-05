<div class="col-lg-5 mb-4 order-0">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-12 mb-4">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h3 class="card-title text-primary">Welcome {{ Auth::guard('manager')->user()->name }} ! 🎉</h3>
              <form method="POST" action="{{ route('manager.logout') }}">
                @csrf
                <a class="btn btn-sm btn-outline-primary" href="{{route('manager.logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Sign Out</span>
                </a>
              </form>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="{{ URL::asset('assets/admin') }}/img/illustrations/man-with-laptop-light.png"
                height="110"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-4 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex  justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/shopping-cart.png" alt="chart success" class="rounded"/>
            </div>
            <h4 class="fw-semibold d-block mb-1 text-start">Purchases</h4>
          </div>
          <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\Purchase::count() > 0 ? \App\Models\Purchase::count() : 0  }}</h3>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-4 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex  justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/transfer.png" alt="chart success" class="rounded"/>
            </div>
            <h4 class="fw-semibold d-block mb-1 text-start">Transfers</h4>
          </div>
          <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\Order::count() > 0 ? \App\Models\Order::count() : 0  }}</h3>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-4 col-4 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex  justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="chart success" class="rounded"/>
            </div>
            <h4 class="fw-semibold d-block mb-1 text-start">Products</h4>
          </div>
          <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\Product::count() > 0 ? \App\Models\Product::count() : 0  }}</h3>
        </div>
      </div>
    </div>
  </div>


</div>