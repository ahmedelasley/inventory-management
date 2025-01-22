@extends('admin.layouts.master')

@section('content')


@php
  $WarehousesCount = \App\Models\Warehouse::get()->count();
  $KitchensCount = \App\Models\Kitchen::get()->count();
  
  $Warehouses = [];
  $WarehouseCount = [];
  $Kitchens = [];
  $KitchenCount = [];
  $colorsWarehouses = [];
  $colorsKitchens = [];
  foreach (\App\Models\Warehouse::get() as $key => $value) {
    $WarehouseCount[] = $value->stocks->sum('quantity') ;
    $Warehouses[] = $value->name;
    $colorsWarehouses[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));

  }

  foreach (\App\Models\Kitchen::get() as $key => $value) {
    $KitchenCount[] = $value->stocks->sum('quantity') ;
    $Kitchens[] = $value->name;
    $colorsKitchens[] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
  }

  $barChartWarehouses = app()->chartjs
        ->name('barChartWarehouses')
        ->type('bar')
        ->size(['width' => 300, 'height' => 100])
        ->labels($Warehouses) // add labels
        ->datasets([
          [
            "label" => 'Warehouses [ ' . $WarehousesCount . ' ]' ,
            'backgroundColor' => $colorsWarehouses,
            'data' => $WarehouseCount
          ],
  ])->options([]);

  $barChartKitchens = app()->chartjs
    ->name('barChartKitchens')
    ->type('bar')
    ->size(['width' => 300, 'height' => 100])
    ->labels($Kitchens) // add labels
    ->datasets([
      [
        "label" => 'Kitchens',
        'backgroundColor' => $colorsKitchens,
        'data' => $KitchenCount
      ],
  ])->options([]);

  $WarehousesStocks = \App\Models\WarehouseStock::sum('quantity');
  $KitchenStocks = \App\Models\KitchenStock::sum('quantity');

  $chartjsStocks = app()->chartjs
    ->name('pieChartStocks')
    ->type('pie')
    ->size(['width' => 400, 'height' => 200])
    ->labels(['Warehouses', 'Kitchens'])
    ->datasets([
      [
        'backgroundColor' => ['#8A2BE2', '#008B8B'],
        'data' => [$WarehousesStocks, $KitchenStocks]
      ],
    ])->options([]); 

@endphp
              <div class="row">
                <div class="col-lg-5 mb-4 order-0">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 mb-4">
                      <div class="card">
                        <div class="d-flex align-items-end row">
                          <div class="col-sm-7">
                            <div class="card-body">
                              <h3 class="card-title text-primary">Welcome {{ Auth::guard('admin')->user()->name }} ! 🎉</h3>
                              <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <a class="btn btn-sm btn-outline-primary" href="{{route('admin.logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
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
                <div class="col-lg-3 mb-4 order-1">
                  <div class="row">
                    <div class="card  h-100">
                      <div class="card-body">
                        <h5 class="card-title mb-0">Stocks Statistics </h5>
                        {!! $chartjsStocks->render() !!}
                      </div>
                    </div>

                  </div>

                </div>
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

              </div>
              <div class="row">

                <!-- Inventory Warehouses -->
                <div class="col-md-8 col-lg-8 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header header-elements">
                      <h5 class="card-title mb-0">Latest Statistics Warehouses</h5>
                      <div class="card-action-element ms-auto py-0">
                        <div class="dropdown">
                          <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icon-base bx bx-calendar"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a></li>
                            <li>
                              <hr class="dropdown-divider" />
                            </li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      {!! $barChartWarehouses->render() !!}
                      {{-- <canvas id="barChartWarehouses" class="chartjs" data-height="400"></canvas> --}}
                    </div>
                  </div>
                </div>
                <!--/ Inventory Warehouses -->

                <!-- Inventory Warehouses -->
                <div class="col-md-6 col-lg-4 order-1 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Inventory Warehouses [5]</h5>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">                  
                        @forelse (\App\Models\Warehouse::with(['keeper', 'stocks'])->withSum('stocks as total_quantity', 'quantity')->take(5)->get() as $item)
                          <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/warehouse.png" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <small class="text-muted d-block mb-1">{{ $item->name }}</small>
                                <h6 class="mb-0">{{ $item->keeper?->name}}</h6>
                              </div>
                              <div class="user-progress d-flex  gap-1 justify-content-start">
                                <h6>Qty : </h6>
                                <h6 class="mb-0 ">{{ $item->total_quantity > 0 ? $item->total_quantity : 0  }}</h6>
                              </div>
                            </div>
                          </li>
                        @empty
                            
                        @endforelse
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Inventory Warehouses -->


              </div>
              <div class="row">
                <!-- Inventory Kitchens -->
                <div class="col-md-6 col-lg-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Inventory Warehouses</h5>
                    </div>
                    <div class="card-body">
                      <ul class="p-0 m-0">
                        @forelse (\App\Models\Kitchen::with(['supervisor', 'stocks'])->withSum('stocks as total_quantity', 'quantity')->take(5)->get() as $item)
                          <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                              <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/kitchen.png" alt="User" class="rounded" />
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                <small class="text-muted d-block mb-1">{{ $item->name }}</small>
                                <h6 class="mb-0">{{ $item->supervisor?->name}}</h6>
                              </div>
                              <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0"><span>Qty : </span>{{ $item->total_quantity > 0 ? $item->total_quantity : 0  }}</h6>
                              </div>
                            </div>
                          </li>
                        @empty
                            
                        @endforelse
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Inventory Kitchens -->

                <!-- Inventory Kitchens -->
                <div class="col-md-8 col-lg-8 order-1 mb-4">
                  <div class="card h-100">
                    <div class="card-header header-elements">
                      <h5 class="card-title mb-0">Latest Statistics Kitchens</h5>
                      <div class="card-action-element ms-auto py-0">
                        <div class="dropdown">
                          <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icon-base bx bx-calendar"></i>
                          </button>
                          <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a></li>
                            <li>
                              <hr class="dropdown-divider" />
                            </li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a></li>
                            <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      {!! $barChartKitchens->render() !!}
                    </div>
                  </div>
                </div>
                <!--/ Inventory Kitchens -->
              </div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection