<div>
    <div class="d-flex justify-content-center flex-wrap mb-3 px-2">
        <div class="input-group-append m-1 ">
              <a wire:click.prevent='clearFilter()' class=" btn btn-danger text-white "><i class='bx bxs-filter-alt'></i></a>
        </div>
        <div class="btn-group m-1">
              <select class="form-select"  wire:model.live="type">
                    <option selected>Choose Product</option>
                    <option value="All">All</option>
                    <option value="Pending">Pending</option>
                    <option value="Send">Send</option>
                    <option value="Processed">Processed</option>
                    <option value="Shipped">Shipped</option>
                    <option value="Received">Received</option>
              </select>
        </div>
        <div class="btn-group m-1">
              <select class="form-select" i wire:model.live="status">
                    <option selected>Choose Status Stock</option>
                    <option value="All">All</option>
                    <option value="Open">Open</option>
                    <option value="Closed">Closed</option>
                    <option value="Draft">Draft</option>
              </select>
        </div>
        <div class="btn-group m-1">
              <input class="form-control" type="date" wire:model.live="fromDate"/>
        </div>
        <div class="btn-group m-1">
              <input class="form-control" type="date" wire:model.live="toDate"/>
        </div>
        <div class="input-group-append m-1 ">
            <a onclick="window.open('{{ route('supervisor.reports.print.orders', [$type, $status, $fromDate, $toDate]) }}', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=200,left=500,width=900,height=900').print()" class="btn btn-primary text-white">
                <i class="bx bx-printer"></i>
            </a>
        </div>
  </div>

  <div class="row">
        <div class="col-md-12 ">
              <!-- Striped Rows -->
              <div class="card mb-2 ">
      
                  <div class="card-title d-flex justify-content-between flex-wrap">
                  </div>

                  <div class="card-body">
                        
                    {{-- @if (count($data) > 0) --}}
                    <div class="table-responsive text-wrap"  style="height : calc(100vh - 420px)">
                        <table class="table table-striped table-hover table-sm text-center">
                            <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                            <tr>
                                <th class="fw-bolder fs-6">#</th>
                                <th class="fw-bolder fs-6">Reference</th>
                                <th class="fw-bolder fs-6">Warehouse</th>
                                <th class="fw-bolder fs-6">Type</th>
                                <th class="fw-bolder fs-6">Status</th>
                                <th class="fw-bolder fs-6">Response Date</th>
                                <th class="fw-bolder fs-6">Created</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($data as $value)
    
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td><a href="{{ route('supervisor.orders.create.order', ['order' => $value]) }}"><strong>{{ $value->code }}</strong></a></td>
                                    <td>{{ $value->warehouse?->name }}</td>

                                    <td>{{ $value->type }}</td>
                                    <td>{{ $value->status }}</td>

                                    <td>{{ $value->response_date }}</td>
                                    <td>{{ $value->createable?->name }}<br>{{ $value->created_at }}</td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">No data to display!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="demo-inline-spacing">
                        <nav aria-label="Page navigation">
                            <ul class="pagination pagination-sm justify-content-end">
                                {{ $data->links() }}
                            </ul>
                        </nav>
                    </div>

                </div>
              </div>
        </div>

        

  </div>
</div>