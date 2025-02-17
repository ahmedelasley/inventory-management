

    <div class="card-body">
        <div class="table-responsive text-wrap"  style="height : calc(100vh - 420px)">
            <table class="table table-striped table-hover table-sm text-center">
                <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                <tr>
                    <th class="fw-bolder fs-6">#</th>
                    <th class="fw-bolder fs-6">Name</th>
                    <th class="fw-bolder fs-6">SKU</th>
                    <th class="fw-bolder fs-6">Qty</th>
                    <th class="fw-bolder fs-6">Cost</th>
                    <th class="fw-bolder fs-6">Total</th>

                    <th class="fw-bolder fs-6">Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($menu->items as $value)

                <tr>
                    <td>{{$loop->iteration }}</td>
                    <td><strong>{{ $value->product?->name }}</strong></td>
                    <td><strong>{{ $value->product?->sku }}</strong></td>
                    <td>{{ number_format($value->quantity, 4)  }} <small>{{ $value->unit }}</small></td>
                    <td>{{ number_format($value->cost, 4)}}</td>
                    <td>{{ number_format($value->total, 4)}}</td>
                    <td>

                        @if(admin()->can('menu-edit-ingredients'))
                            <a class="text-success me-1" href="javascript:void(0);"
                                wire:click.prevent="$dispatch('itemUpdate', { id: {{ $value->id }} })"
                            >
                                <i class="bx bx-edit-alt me-1"></i>
                            </a>
                        @endif

                        @if(admin()->can('menu-delete-ingredients'))
                            <a class="text-danger ms-1" href="javascript:void(0);"
                                wire:click.prevent="$dispatch('itemDelete', { id: {{ $value->id }} })"
                            >
                                <i class="bx bx-trash me-1"></i>
                            </a>
                        @endif

                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="11">No data to display! - Add new data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        
        </div>
        
    </div>
