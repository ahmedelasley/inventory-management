@extends('supervisor.layouts.print')

@section('title', 'Reports')
@section('css')

@section('content')
<!-- Content -->
<div class="container-fluid flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between  mb-2">
            <h4 class="fw-bolder fs-4">Reports [ Orders Transactions ]</h4>
            {{-- <a href="{{ route('supervisor.reports.index') }}" class="btn btn-primary btn-round btn-sm d-block">
                  <span class="ion ion-md-arrow-back"></span> Back
            </a>  --}}
      </div>

      <div class="row">
            <div class="col-md-12 ">
                  <!-- Striped Rows -->
                  <div class="card mb-2 ">
          
                      <div class="card-title d-flex justify-content-between flex-wrap">
                      </div>
    
                      <div class="card-body">
                            
                        {{-- @if (count($data) > 0) --}}
                        <div class="text-wrap">
                            <table class="table table-striped table-sm text-center">
                                <thead class="bg-white sticky-top" style="z-index: 3;">
                                <tr>
                                    <th class="fw-bolder fs-6">#</th>
                                    <th class="fw-bolder fs-6">Order</th>
                                    <th class="fw-bolder fs-6">Old Status</th>
                                    <th class="fw-bolder fs-6">New Status</th>
                                    <th class="fw-bolder fs-6">Date</th>
                                    <th class="fw-bolder fs-6">Created At</th>
                                </tr>
                                </thead>
                                <tbody class="">
                                    @forelse ($data as $value)
        
                                    <tr>
                                        <td>{{$loop->iteration }}</td>
                                        <td>{{ $value->order?->code }}</td>
                                        <td>{{ $value->old_status }}</td>
                                        <td>{{ $value->new_status }}</td>
                                        <td>{{ $value->date }}</td>
                                        <td>{{ $value->statusable?->name }}<br>{{ $value->created_at }}</td>
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
