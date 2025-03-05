  <div class="col-lg-3 col-md-3 col-3 mb-4">
    <div class="card  h-100">
      <div class="card-body">
        <h5 class="card-title mb-0">Top 5 products in Stock </h5>
        <ul class="p-0 m-0 mt-4">
          @forelse ($data as $item)
            <li class="d-flex mb-4 pb-1">
              {{-- <div class="avatar flex-shrink-0 me-3">
                <img src="{{ URL::asset('assets/admin') }}/img/icons/unicons/kitchen.png" alt="User" class="rounded" />
              </div> --}}
              <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                <div class="me-2">
                  <small class="text-muted d-block mb-1">{{ $item->product?->name }}</small>
                  <h6 class="mb-0">{{ $item->product?->sku}}</h6>
                </div>
                <div class="user-progress d-flex align-items-center gap-1">
                  <h6 class="mb-0"><span>Qty : </span>{{ $item->quantity  > 0 ? $item->quantity  : 0  }}</h6>
                </div>
              </div>
            </li>
          @empty
              
          @endforelse
        </ul>
      </div>
    </div>

</div>