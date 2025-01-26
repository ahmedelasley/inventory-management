@extends('supervisor.layouts.print')

@section('title', 'Reports')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h4 class="fw-bolder fs-4">Reports [ Stocks ]</h4>
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
                                    <th class="fw-bolder fs-6">Name</th>
                                    <th class="fw-bolder fs-6">SKU</th>
                                    <th class="fw-bolder fs-6">Qty Stock</th>
                                    <th class="fw-bolder fs-6">Production Date</th>
                                    <th class="fw-bolder fs-6">Expiration Date</th>
                                    <th class="fw-bolder fs-6">Created At</th>
                                </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @forelse ($data as $value)
        
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td><a href="{{ route('supervisor.kitchens.show.transaction', $value) }}">{{ $value->product->name }}</a></td>
                                        <td>{{ $value->product->sku }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td>{{ $value->production_date }}</td>
                                        <td>{{ $value->expiration_date }}</td>
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
       
                    </div>
                  </div>
            </div>
    
            
    
      </div>

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
