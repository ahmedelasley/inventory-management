  <!-- Inventory Warehouses -->
  <div class="col-md-8 col-lg-8 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header header-elements">
        <h5 class="card-title mb-0">Latest Statistics Warehouses</h5>
        <div class="card-action-element ms-auto py-0">
        </div>
      </div>
      <div class="card-body">
        {!! $barChartWarehouses->render() !!}
        {{-- <canvas id="barChartWarehouses" class="chartjs" data-height="400"></canvas> --}}
      </div>
    </div>
  </div>
<!--/ Inventory Warehouses -->