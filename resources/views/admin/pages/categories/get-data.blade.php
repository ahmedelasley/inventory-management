
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
                          <li><a class="dropdown-item" href="javascript:void(0);" wire:click="searchField('name')">Name</a></li>
                          {{-- <li><a class="dropdown-item" href="javascript:void(0);" wire:click="searchField('code')">Code</a></li> --}}
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
                    {{-- <button type="button" class="btn btn-sm btn-outline-primary ms-2" wire:click="exportPDF"><i class='bx bxs-file-pdf'></i> PDF</button> --}}
                    <button type="button" class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#importModal"><i class='bx bx-spreadsheet' ></i> Import</button>
                    {{-- <button type="button" class="btn btn-sm btn-outline-success ms-2" wire:click="exportExcel"><i class='bx bx-spreadsheet' ></i> Export</button> --}}
                    <button type="button" class="btn btn-sm btn-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteSelectedModal" @if(empty($selectedRows)) disabled @endif><i class="bx bx-trash me-1"></i> Delete</button>
                    @include('admin.pages.categories.partials.import')
                    @include('admin.pages.categories.partials.delete-selected')

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
                            <th class="fw-bolder fs-6">
                                <input
                                class="form-check-input mt-0"
                                type="checkbox"
                                wire:model="selectAllStatus"
                                wire:click="selectAll"
                                aria-label="Checkbox for following text input"
                              />
                            </th>
                            <th class="fw-bolder fs-6">#</th>
                            <th class="fw-bolder fs-6">Name</th>
                            <th class="fw-bolder fs-6">Description</th>
                            <th class="fw-bolder fs-6">Parent</th>
                            <th class="fw-bolder fs-6">Type</th>
                            <th class="fw-bolder fs-6">Created At</th>
                            <th class="fw-bolder fs-6">Updated At</th>
                            <th class="fw-bolder fs-6">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($data as $value)

                        <tr>
                            <td>
                                @if (!$value->is_default)
                                    <input
                                    class="form-check-input mt-0"
                                    type="checkbox"
                                    wire:model.live="selectedRows" value="{{ $value->id }}"
                                    aria-label="Checkbox for following text input"
                                />
                              @endif
                            </td>
                            <td>{{$data->firstItem()+$loop->index  }}</td>
                            <td><strong>{{ $value->name }}</strong></td>
                            <td>{{ $value->description }}</td>
                            <td><span class="badge bg-label-primary me-1">{{ $value->parent?->name }}</span></td>
                            <td><span class="badge bg-label-success me-1">{{ $value->type == 0 ? 'Stock' : 'Menu'}}</span></td>
                            <td>{{ $value->creator?->name }}<br>{{ $value->created_at }}</td>
                            {{-- <td>{{ $value->updater?->name }}<br>{{ $value->updated_at }}</td> --}}
                            <td>{{ $value->updater == NULL ? "" : $value->updater?->name }}<br>{{ $value->updater == NULL ? "" : $value->updated_at  }}</td>
                            <td>
                                @if (!$value->is_default)
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-primary btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        Actions <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">

                                            @if(admin()->can('category-read'))
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    wire:click="$dispatch('categoryShow', { id: {{ $value->id }} })"
                                                >
                                                    <i class="bx bx-show me-1"></i> Show
                                                </a>                                    
                                            @endif

                                            @if(admin()->can('category-edit'))
                                                <a class="dropdown-item" href="javascript:void(0);"
                                                    wire:click="$dispatch('categoryUpdate', { id: {{ $value->id }} })"
                                                >
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                </a>                                    
                                            @endif
                                
                                            @if(admin()->can('category-delete'))
                                                <a class="dropdown-item" href="#"
                                                    wire:click.prevent="$dispatch('categoryDelete', { id: {{ $value->id }} })"
                                                >
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
                                <td colspan="7">No data to display! - Add new data</td>
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