@extends('supervisor.layouts.print')

@section('title', 'Reports')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h4 class="fw-bolder fs-4">Reports [ Orders ]</h4>
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
    
                    </div>
                  </div>
            </div>
    
            
    
      </div>

</div>
<!-- / Content -->


@endsection
@section('js')
@endsection
