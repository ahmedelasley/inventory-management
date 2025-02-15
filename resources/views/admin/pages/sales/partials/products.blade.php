<div class="card shadow-none bg-transparent">

    <div class="card-title d-flex justify-content-between flex-wrap">
        <div class="d-flex justify-content-start ms-3">
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
                  <li><a class="dropdown-item {{ $field == 'name' ? 'active' : ''}}" href="javascript:void(0);" wire:click="searchField('name')">Name</a></li>
                  <li><a class="dropdown-item {{ $field == 'sku' ? 'active' : ''}}" href="javascript:void(0);" wire:click="searchField('sku')">SKU</a></li>
                  <li>
                    <hr class="dropdown-divider" />
                  </li>
                  <li><a class="dropdown-item {{ $field == 'category' ? 'active' : ''}}" href="javascript:void(0);" wire:click="searchField('category')">Categry</a></li>
                </ul>
            </div>
        </div>
        <select wire:model.live="paginate" class="form-control w-10 me-3" style="width:75px" id="paginate">
            <option disabled value="">Select a Paginate...</option>
            {{-- <option value="{{ getSetting('pagination') }}">{{ getSetting('pagination') }} *</option> --}}
            <option value="12">12</option>
            <option value="24">24</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
        </select>
    </div>
    <div class="card-body table-wrapper-scroll-y my-custom-scrollbar" style="height : calc(100vh - 250px)">
        <div class="row d-flex justify-content-between">
            @forelse ($products as $value)
                @if($sale->status == 'Open' && $sale->type == 'Pending')
                    <a class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3" wire:click.prevent="addItem('{{ $sale->id }}', '{{ $value->id }}')" href="javascript:void(0);">
                @else
                    <a class="col-xs-6 col-sm-6 col-md-6 col-lg-4 col-xl-3"href="javascript:void(0);">
                @endif
                    <div class="backgroundEffect shadow action-button">
                        {{-- <div class="card-header">
                            <div class="d-flex justify-content-between ">
                                <strong class="text-primary fw-bold"><span class="badge bg-label-primary me-1">{{ $value->category?->name }}</span></strong>
                                <strong class="text-primary fw-bold">
                                    @if( $value->is_active)
                                        <span class="badge bg-label-success me-1">Active</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">Inactive</span>
                                    @endif
                                </strong>
            
                            </div>
                        </div> --}}
                        <div class="text-center" style="height: 160px;">
                            @if($value->image)
                                <img src="{{ $value->image }}" alt="{{ $value->name }}" class="rounded" width="100%" height="100" />
                            @else
                                <img src="https://placehold.co/170x90/696cff/ffffff?font=roboto&text={{ getInitials($value->name) }}" alt="{{ $value->name }}" class="rounded" width="100%" height="100" />
                            @endif
                            <h6 class="text-primary fw-bold mt-1">{{ $value->name }}</h6>
                        </div>
                        <div class="d-flex justify-content-between px-2">
                            <strong class="text-primary fw-semibold">{{ $value->sku }}</strong>
                            <strong class="text-primary fw-semibold">{{ number_format($value->price, 2) }} <small class="text-light">SAR</small></strong>
                        </div>
                    </div>
                </a>
            @empty
                <div class="alert alert-primary" role="alert">No Products to display!</div>
            @endforelse
        </div>
    </div>
    <div class="card-footer">
        {{-- <div class="demo-inline-spacing"> --}}
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-end">
                    {{ $products->links() }}
                </ul>
            </nav>
        {{-- </div> --}}
    </div>
</div>