                <!-- Inventory Kitchens -->
                <div class="col-md-6 col-lg-4 order-0 mb-4">
                  <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="card-title m-0 me-2">Inventory Kitchens</h5>
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