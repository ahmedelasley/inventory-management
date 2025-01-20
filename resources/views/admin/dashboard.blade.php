@extends('admin.layouts.master')

@section('css')

@section('content')
            <div class="row">
                <div class="col-lg-4 mb-4 order-0">
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
                <div class="col-lg-8 mb-4 order-1">
                  <div class="row">
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

              </div>
              <div class="row">
                <!-- Inventory Warehouses -->
                <div class="col-md-6 col-lg-4 order-1 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Inventory Warehouses</h5>
                      {{-- <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="transactionID"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                          <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                      </div> --}}
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
                              <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0">{{ $item->total_quantity > 0 ? $item->total_quantity : 0  }}</h6>
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

                <!-- Inventory Kitchens -->
                <div class="col-md-6 col-lg-4 order-3 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Inventory</h5>
                      {{-- <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="transactionID"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                          <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                      </div> --}}
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
                                <h6 class="mb-0">{{ \App\Models\WarehouseStock::sum('quantity') > 0 ? \App\Models\WarehouseStock::sum('quantity') : 0  }}</h6>
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
                                <h6 class="mb-0">{{ \App\Models\KitchenStock::sum('quantity') > 0 ? \App\Models\KitchenStock::sum('quantity') : 0  }}</h6>
                              </div>
                            </div>
                          </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <!--/ Inventory Kitchens -->

                                
                <!-- Inventory Kitchens -->
                <div class="col-md-6 col-lg-4 order-3 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Inventory Kitchens</h5>
                      {{-- <div class="dropdown">
                        <button
                          class="btn p-0"
                          type="button"
                          id="transactionID"
                          data-bs-toggle="dropdown"
                          aria-haspopup="true"
                          aria-expanded="false"
                        >
                          <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                          <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                          <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                        </div>
                      </div> --}}
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
                                <h6 class="mb-0">{{ $item->total_quantity > 0 ? $item->total_quantity : 0  }}</h6>
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
              </div>
@endsection
@section('js')
