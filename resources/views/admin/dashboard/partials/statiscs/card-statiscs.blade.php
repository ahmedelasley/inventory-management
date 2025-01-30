<div class="row">

    <div class="col-lg-6 col-md-6 col-12 mb-4">
        <div class="row">
            <!-- Products -->
            <div class="col-lg-4 col-md-4 col-4 col-12 mb-4">
                <div class="card bg-primary p-0">
                    <div class="card-body">
                        <h4 class="text-white text-center">Welcome 🎉 in Administrator Panel</h4>
                    </div>
                </div>
            </div>

            <!-- Suppliers -->
            <div class="col-lg-4 col-md-4 col-4 col-12 mb-4">
                <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex  justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/supplier.png" alt="chart success" class="rounded"/>
                    </div>
                    <h4 class="fw-semibold d-block mb-1 text-start">Suppliers</h4>
                    </div>
                    <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\Purchase::count() > 0 ? \App\Models\Purchase::count() : 0  }}</h3>
                </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="col-lg-4 col-md-4 col-4 col-12 mb-4">
                <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex  justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/list.png" alt="chart success" class="rounded"/>
                    </div>
                    <h4 class="fw-semibold d-block mb-1 text-start">Categories</h4>
                    </div>
                    <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\Purchase::count() > 0 ? \App\Models\Purchase::count() : 0  }}</h3>
                </div>
                </div>
            </div>

            <!-- Products -->
            <div class="col-lg-4 col-md-4 col-4 col-12 mb-4">
                <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex  justify-content-between">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/products.png" alt="chart success" class="rounded"/>
                    </div>
                    <h4 class="fw-semibold d-block mb-1 text-start">Products</h4>
                    </div>
                    <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\Purchase::count() > 0 ? \App\Models\Purchase::count() : 0  }}</h3>
                </div>
                </div>
            </div>
            <!-- Products -->
            <div class="col-lg-4 col-md-4 col-4 col-12 mb-4">
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
            <!-- Products -->
            <div class="col-lg-4 col-md-4 col-4 col-12 mb-4">
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
            
        </div>
    </div>


    @php
    use App\Models\{WarehouseStock, KitchenStock, Restaurant, Kitchen, Warehouse};
    use Illuminate\Support\Facades\DB;

    // حساب الكميات والتكاليف مسبقًا لتقليل الاستعلامات
    $warehouseQty = WarehouseStock::sum('quantity');
    $kitchenQty = KitchenStock::sum('quantity');
    
    $warehouseCost = WarehouseStock::sum(DB::raw('quantity * cost'));
    $kitchenCost = KitchenStock::sum(DB::raw('quantity * cost'));

    $totalQty = $warehouseQty + $kitchenQty;
    $totalCost = $warehouseCost + $kitchenCost;

    // عدد المطاعم والمطابخ والمخازن
    $restaurantsCount = Restaurant::count();
    $kitchensCount = Kitchen::count();
    $warehousesCount = Warehouse::count();
@endphp

<div class="col-lg-6 col-md-6 col-12 mb-4">
    <div class="row">
        <!-- Inventory -->
        <div class="col-lg-12 col-md-12 col-12 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2">Inventory</h5>
                </div>
                <div class="card-body">
                    <div class="card-title d-flex justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/admin/img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded"/>
                        </div>
                        <h4 class="fw-semibold d-block mb-1 text-start">Inventory</h4>
                    </div>
                    <div class="user-progress d-flex justify-content-evenly">
                        <h4 class="card-title mb-2 pt-2 text-center">{{ $totalQty }}</h4>
                        <h4 class="card-title mb-2 pt-2 text-center">{{ number_format($totalCost, 2) }} <small>SAR</small></h4>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="p-0 m-0">
                        <!-- Restaurants -->
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('assets/admin/img/icons/unicons/restaurant.png') }}" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Restaurants <span class="badge bg-label-primary">{{ $restaurantsCount }}</span></h6>
                                </div>
                                <div class="user-progress text-start">
                                    <h6 class="mb-2 text-primary">Qty : {{ number_format($totalQty, 2) }}</h6>
                                    <h6 class="mb-2 text-success">Cost : {{ number_format($totalCost, 2) }} SAR</h6>
                                </div>
                            </div>
                        </li>

                        <!-- Kitchens -->
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('assets/admin/img/icons/unicons/kitchen.png') }}" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Kitchens <span class="badge bg-label-primary">{{ $kitchensCount }}</span></h6>
                                </div>
                                <div class="user-progress text-start">
                                    <h6 class="mb-2 text-primary">Qty : {{ number_format($kitchenQty, 2) }}</h6>
                                    <h6 class="mb-2 text-success">Cost : {{ number_format($kitchenCost, 2) }} SAR</h6>
                                </div>
                            </div>
                        </li>

                        <!-- Warehouses -->
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <img src="{{ asset('assets/admin/img/icons/unicons/warehouse.png') }}" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Warehouses <span class="badge bg-label-primary">{{ $warehousesCount }}</span></h6>
                                </div>
                                <div class="user-progress text-start">
                                    <h6 class="mb-2 text-primary">Qty : {{ number_format($warehouseQty, 2) }}</h6>
                                    <h6 class="mb-2 text-success">Cost : {{ number_format($warehouseCost, 2) }} SAR</h6>
                                </div>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Inventory -->
    </div>
</div>




      {{-- <div class="col-lg-4 col-md-4 col-4 mb-4">
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
      </div> --}}
  
      {{-- <div class="col-lg-4 col-md-4 col-4 mb-4">
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
      </div> --}}
</div>