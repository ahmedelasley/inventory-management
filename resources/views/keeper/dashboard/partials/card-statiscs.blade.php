<div class="col-lg-7 mb-4 order-0">
  <div class="row">

    <div class="col-lg-3 col-md-3 col-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex  justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="chart success" class="rounded"/>
            </div>
            <h4 class="fw-semibold d-block mb-1 text-start">Products</h4>
          </div>
          <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\WarehouseStock::ofWarehouse(Auth::guard('keeper')->user()->warehouse->id)->count() > 0 ? \App\Models\WarehouseStock::ofWarehouse(Auth::guard('keeper')->user()->warehouse->id)->count() : 0  }}</h3>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-3 col-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex  justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="chart success" class="rounded"/>
            </div>
            <h4 class="fw-semibold d-block mb-1 text-start">Inventory</h4>
          </div>
          <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\WarehouseStock::ofWarehouse(Auth::guard('keeper')->user()->warehouse->id)->sum('quantity') > 0 ? \App\Models\WarehouseStock::ofWarehouse(Auth::guard('keeper')->user()->warehouse->id)->sum('quantity') : 0  }}</h3>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-3 col-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex  justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/shopping-cart.png" alt="chart success" class="rounded"/>
            </div>
            <h4 class="fw-semibold d-block mb-1 text-start">Purchases</h4>
          </div>
          <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\Purchase::ofWarehouse(Auth::guard('keeper')->user()->warehouse->id)->count() > 0 ? \App\Models\Purchase::ofWarehouse(Auth::guard('keeper')->user()->warehouse->id)->count() : 0  }}</h3>
        </div>
      </div>
    </div>

    <div class="col-lg-3 col-md-3 col-3 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="card-title d-flex  justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/transfer.png" alt="chart success" class="rounded"/>
            </div>
            <h4 class="fw-semibold d-block mb-1 text-start">Transfers</h4>
          </div>
          <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\Order::ofWarehouse(Auth::guard('keeper')->user()->warehouse->id)->count() > 0 ? \App\Models\Order::ofWarehouse(Auth::guard('keeper')->user()->warehouse->id)->count() : 0  }}</h3>
        </div>
      </div>
    </div>

  </div>
  </div>