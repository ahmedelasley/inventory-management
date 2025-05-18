<div class="row">
    <div class="col-md-12">
        <!-- Card Container -->
        <div class="card mb-2">
            <div class="card-title d-flex justify-content-between flex-wrap p-3">
                <!-- Search and Filters -->
                <div class="d-flex">
                    <x-text-input id="search" wire:model.live="search" type="text" class="form-control w-100" placeholder="Search..."/>
                    
                    <!-- Filter Dropdown -->
                    <div class="btn-group ms-2">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class='bx bx-filter-alt'></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" wire:click="searchField('name')">Name</a></li>
                            <li><a class="dropdown-item" href="#" wire:click="searchField('code')">Code</a></li>
                            <li><a class="dropdown-item" href="#" wire:click="searchField('phone')">Phone</a></li>
                        </ul>
                    </div>

                    <!-- Export Dropdown -->
                    <div class="btn-group ms-2">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                            <i class='bx bx-cloud-download'></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" wire:click="exportPDF">Export PDF</a></li>
                            <li><a class="dropdown-item" href="#" wire:click="exportExcel">Export Excel</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" wire:click="exportPDF">Export PDF to Mail</a></li>
                            <li><a class="dropdown-item" href="#" wire:click="exportExcel">Export Excel to Mail</a></li>
                        </ul>
                    </div>

                    <!-- Include Other Components -->
                    @include('admin.pages.clients.partials.import')
                    @include('admin.pages.clients.partials.delete-selected')
                </div>

                <!-- Pagination Select -->
                <select wire:model.live="paginate" class="form-control w-10 mt-3 me-3" style="width:75px">
                    <option disabled value="">Select Pagination...</option>
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
                <!-- Table -->
                <div class="table-responsive text-wrap" style="height: calc(100vh - 420px)">
                    <table class="table table-striped table-hover table-sm text-center">
                        <thead class="bg-white border-0 sticky-top"  style="z-index: 3;">
                            <tr>
                                <th class="fw-bolder">#</th>
                                <th class="fw-bolder">Code</th>
                                <th class="fw-bolder">Name</th>
                                <th class="fw-bolder">Phone</th>
                                <th class="fw-bolder">Email</th>
                                <th class="fw-bolder">Address</th>
                                <th class="fw-bolder">Created At</th>
                                <th class="fw-bolder">Updated At</th>
                                <th class="fw-bolder">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><strong>{{ $value->code }}</strong></td>
                                <td><strong>{{ $value->name }}</strong></td>
                                <td>{{ $value->phone }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->address }}</td>
                                <td>
                                    {{ $value->creator }} <br>
                                    {{ $value->created_at }}
                                </td>
                                <td>
                                    {{ $value->editor?->name ?? '' }} <br>
                                    {{ $value->updated_at ?? '' }}
                                </td>
                                <td>
                                    @if (!$value->is_default)
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                                Actions <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                @if(admin()->can('client-read'))
                                                    <a class="dropdown-item" href="#" wire:click.prevent="$dispatch('clientShow', { id: {{ $value->id }} })">
                                                        <i class="bx bx-show me-1"></i> Show
                                                    </a>                                  
                                                @endif

                                                @if(admin()->can('client-edit'))
                                                    <a class="dropdown-item" href="#" wire:click.prevent="$dispatch('clientUpdate', { id: {{ $value->id }} })">
                                                        <i class="bx bx-edit-alt me-1"></i> Edit
                                                    </a>                                  
                                                @endif
                                    
                                                @if(admin()->can('client-delete'))
                                                    <a class="dropdown-item text-danger" href="#" wire:click.prevent="$dispatch('clientDelete', { id: {{ $value->id }} })">
                                                        <i class="bx bx-trash me-1"></i> Delete
                                                    </a>
                                                @endif

                                            </div>
                                        </div>
                                    @else
                                        <span class="badge bg-label-primary">Default</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <div class="alert alert-primary">No data to display! - Add new data</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav class="mt-2">
                    <ul class="pagination pagination-sm justify-content-end">
                        {{ $data->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
