<div class="col-lg-4 mb-4 order-2">
  <div class="row">
    <!-- Inventory -->
    <div class="col-lg-12 col-md-12 col-12 mb-4">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Inventory</h5>
        </div>
        <div class="card-body">
          <div class="card-title d-flex  justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/chart-success.png" alt="chart success" class="rounded"/>
            </div>
            <h4 class="fw-semibold d-block mb-1 text-start">Inventory</h4>
          </div>
          <h3 class="card-title mb-2 pt-2 text-center">{{ \App\Models\WarehouseStock::sum('quantity') + \App\Models\KitchenStock::sum('quantity')}}</h3>
        </div>
        <div class="card-body">
          <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/warehouse.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    {{-- <small class="text-muted d-block mb-1">{{ $item->name }}</small> --}}
                    <h6 class="mb-0">Warehouses</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">Qty : {{ \App\Models\WarehouseStock::sum('quantity') > 0 ? \App\Models\WarehouseStock::sum('quantity') : 0  }}</h6>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/kitchen.png" alt="User" class="rounded" />
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    {{-- <small class="text-muted d-block mb-1">{{ $item->name }}</small> --}}
                    <h6 class="mb-0">Kitchens</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0"><span>Qty : </span>{{ \App\Models\KitchenStock::sum('quantity') > 0 ? \App\Models\KitchenStock::sum('quantity') : 0  }}</h6>
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