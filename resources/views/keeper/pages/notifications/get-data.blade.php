
<div class="row">
    <div class="col-md-12">
        <!-- Striped Rows -->
        <div class="card mb-2 ">

            <div class="card-title d-flex justify-content-between flex-wrap">
                <div class="d-flex justify-content-start mt-3 ms-3">
                    <x-text-input id="search" wire:model.live="search" type="text" class="form-control w-100" placeholder="Search..."/>
                    <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-primary dropdown-toggle ms-2"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                        <i class='bx bx-filter-alt'></i>
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item {{ $field == 'title' ? 'active' : ''}}" href="javascript:void(0);" wire:click="searchField('title')">Title</a></li>
                          <li><a class="dropdown-item {{ $field == 'body' ? 'active' : ''}}" href="javascript:void(0);" wire:click="searchField('body')">Content</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button
                          type="button"
                          class="btn btn-outline-primary dropdown-toggle ms-2"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                        <i class='bx bx-cloud-download'></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="javascript:void(0);" wire:click="exportPDF">Export PDF</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" wire:click="exportExcel">Export Excel</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" wire:click="exportPDF">Export PDF to Mail</a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);" wire:click="exportExcel">Export Excel to Mail</a></li>
                        </ul>
                    </div>


                </div>
                <select wire:model.live="paginate" class="form-control w-10 mt-3 me-3" style="width:75px" id="paginate">
                    <option disabled value="">Select a Paginate...</option>
                    <option value="{{ getSetting('pagination') }}">{{ getSetting('pagination') }} *</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                </select>
            </div>

            <div class="card-body">
                <div class="table-responsive text-wrap"  style="height : calc(100vh - 420px)">
                    <table class="table table-striped table-hover table-sm text-center">
                        <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                        <tr>
                            <th class="fw-bolder fs-6">#</th>
                            <th class="fw-bolder fs-6">Title</th>
                            <th class="fw-bolder fs-6">Content</th>
                            <th class="fw-bolder fs-6">Read At</th>
                            <th class="fw-bolder fs-6">Created At</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($data as $value)

                        <tr>
                            <td>{{$loop->iteration }}</td>
                             
                            <td><b>{{ $value->data['details']['title'] }}</b></td>
                            <td>{{ $value->data['details']['body'] }}</td>
                            <td><b>{{ $value->read_at?->DiffForHumans() }}</b></td>
                            <td><b>{{ $value->created_at->DiffForHumans() }}</b></td>

                        </tr>
                        @empty
                        <p>No data to display! - Add new data</p>
                        @endforelse
                        </tbody>
                    </table>
                    
                </div>
                <div class="demo-inline-spacing">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm justify-content-end">
                            {{-- {{ $data->links() }} --}}
                        </ul>
                    </nav>
                </div>
  
            </div>
        </div>
    </div>
</div>