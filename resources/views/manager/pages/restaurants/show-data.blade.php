<div class="row">

    <div class="col-md-6">
        <!-- Striped Rows -->
        <div class="card mb-2 ">

            <div class="card-title d-flex justify-content-between flex-wrap">
                <div class="d-flex justify-content-start mt-3 ms-3">
                    <h5 class="fw-bolder fs-5">Warehouses</h5>
                </div>
            </div>

            <div class="card-body">
                
                {{-- @if (count($data) > 0) --}}
                <div class="table-responsive text-wrap"  style="height : calc(100vh - 420px)">
                    <table class="table table-striped table-hover table-sm text-center">
                        <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                        <tr>
                            <th class="fw-bolder fs-6">#</th>
                            <th class="fw-bolder fs-6">Code</th>
                            <th class="fw-bolder fs-6">Name</th>
                            <th class="fw-bolder fs-6">Location</th>
                            <th class="fw-bolder fs-6">Keeper</th>
                            <th class="fw-bolder fs-6">Creator</th>
                            <th class="fw-bolder fs-6">Editor</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($warehouses as $value)

                        <tr>
                            <td>{{$loop->iteration }}</td>
                            <td>{{ $value->code }}</td>
                            <td>
                                @if(manager()->can('warehouse-show-inventory'))
                                    <a href="{{ route('manager.warehouses.show', $value) }}"><strong><i class='bx bxs-store'></i> {{ $value->name }}</strong></a>
                                @else
                                    <strong><i class='bx bxs-store'></i> {{ $value->name }}</strong>
                                @endif
                            </td>
                            <td>{{ $value->location }}</td>
                            <td><span class="badge bg-label-primary me-1">{{ $value->keeper?->name }}</span></td>
                            <td>{{ $value->creator?->name }}<br>{{ $value->created_at }}</td>
                            {{-- <td>{{ $value->updater?->name }}<br>{{ $value->updated_at }}</td> --}}
                            <td>{{ $value->updater == NULL ? "" : $value->updater?->name }}<br>{{ $value->updater == NULL ? "" : $value->updated_at  }}</td>
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
                                {{ $warehouses->links() }}
                            </ul>
                        </nav>
                    </div>
                {{-- @else
                    <div class="alert alert-primary" role="alert">
                    No data to display! - Add new data
                    </div>
                @endif --}}
                </div>
        </div>
    </div>

    <div class="col-md-6">
        <!-- Striped Rows -->
        <div class="card mb-2 ">

            <div class="card-title d-flex justify-content-between flex-wrap">
                <div class="d-flex justify-content-start mt-3 ms-3">
                    <h5 class="fw-bolder fs-5">Kitchens</h5>
                </div>
            </div>

            <div class="card-body">
                
                {{-- @if (count($data) > 0) --}}
                <div class="table-responsive text-wrap"  style="height : calc(100vh - 420px)">
                    <table class="table table-striped table-hover table-sm text-center">
                        <thead class="bg-white border-0 sticky-top" style="z-index: 3;">
                        <tr>
                            <th class="fw-bolder fs-6">#</th>
                            <th class="fw-bolder fs-6">Code</th>
                            <th class="fw-bolder fs-6">Name</th>
                            <th class="fw-bolder fs-6">Location</th>
                            <th class="fw-bolder fs-6">Supervisor</th>
                            <th class="fw-bolder fs-6">Creator</th>
                            <th class="fw-bolder fs-6">Editor</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($kitchens as $value)

                        <tr>
                            <td>{{$loop->iteration }}</td>
                            <td>{{ $value->code }}</td>
                            <td>
                                @if(manager()->can('kitchen-show-inventory'))
                                    <a href="{{ route('manager.kitchens.show', $value) }}"><strong><i class='bx bxs-store'></i> {{ $value->name }}</strong></a>
                                @else
                                    <strong><i class='bx bxs-store'></i> {{ $value->name }}</strong>
                                @endif
                            </td>
                            <td>{{ $value->location }}</td>
                            <td><span class="badge bg-label-primary">{{ $value->supervisor?->name }}</span></td>
                            <td>{{ $value->creator?->name }}<br>{{ $value->created_at }}</td>
                            {{-- <td>{{ $value->updater?->name }}<br>{{ $value->updated_at }}</td> --}}
                            <td>{{ $value->updater == NULL ? "" : $value->updater?->name }}<br>{{ $value->updater == NULL ? "" : $value->updated_at  }}</td>
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
                                {{ $kitchens->links() }}
                            </ul>
                        </nav>
                    </div>
                {{-- @else
                    <div class="alert alert-primary" role="alert">
                    No data to display! - Add new data
                    </div>
                @endif --}}
                </div>
        </div>
    </div>

</div>