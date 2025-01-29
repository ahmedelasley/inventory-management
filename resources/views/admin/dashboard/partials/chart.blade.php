<div class="col-lg-6 col-md-6 col-6 mb-4">
  <div class="card  h-100">
    <div class="card-header d-flex justify-content-between">
      <h5 class="card-title mb-0">Stocks of Orders Statistics {{-- $yearChart --}} </h5>
      {{-- <div class="text-center">
        <div class="dropdown">
          <button
            class="btn btn-sm btn-outline-primary dropdown-toggle"
            type="button"
            id="growthReportId"
            data-bs-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
          >
          {{ $yearChart }}
          </button>
          <ul class="dropdown-menu">
            @php
                $fromYear = (int) getSetting('year'); // تأكد من أن السنة رقم صحيح
                $toYear = (int) date('Y'); // تحويل السنة الحالية إلى رقم صحيح
            @endphp
            
            @if ($fromYear <= $toYear)
                @foreach (range($fromYear, $toYear) as $year)
                    <li>
                        <a class="dropdown-item {{ $yearChart == $year ? 'active' : ''}}" href="javascript:void(0);" wire:click="setYear({{ $year }})">{{ $year }}</a>
                    </li>
                @endforeach
            @else
                <li>
                    <a class="dropdown-item" href="javascript:void(0);">No years available</a>
                </li>
            @endif
          </ul>
        </div>
      </div> --}}
    </div>
    <div class="card-body">
      {!! $barChartOrders->render() !!}
    </div>
  </div>

</div>