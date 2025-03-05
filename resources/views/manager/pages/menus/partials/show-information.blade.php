
    <div class="card-body">
        <div class="d-flex flex-column align-items-start align-items-sm-center gap-4">
            @if($menu->image)
                <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="rounded" width="90%" height="200" />
            @else
                <img src="https://placehold.co/400x200/696cff/ffffff?font=roboto&text={{ getInitials($menu->name) }}" alt="{{ $menu->name }}" class="rounded" width="100%" height="200" />
            @endif
            <h6 class="text-primary fw-bold py-3 text-center">{{ $menu->name }}</h6>
        </div>
        <div>
            <!-- List group Icons -->
            <div class="col-lg-12">
                <div class="d-flex justify-content-between ">
                    <strong class="text-primary fw-bold">{{ $menu->sku }}</strong>
                    <strong class="text-primary fw-bold">{{ $menu->price }} <small class="text-light fw-semibold">SAR</small></strong>

                </div>
                <div class="demo-inline-spacing mt-3">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center text-wrap">
                            <span><small class="text-light me-2">Restaurant</small> <strong class="badge bg-label-primary me-1">{{ $menu->restaurant?->name }}</strong></span>
                            <span><small class="text-light me-2">Kitchen</small> <strong class="badge bg-label-primary me-1">{{ $menu->kitchen?->name }}</strong></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center text-wrap">
                            <span><small class="text-light me-2">No. Items</small> <strong>{{ $menu->items->count() }}</strong></span>
                            <span><small class="text-light me-2">Cost</small> <strong>{{ $menu->items->sum('total') }}</strong></span>
                        </li>
                        <li class="list-group-item d-flex align-items-center text-wrap">
                            <small class="text-light me-2">{{ __('Barcode') }}</small> <strong>{{ $menu->barcode }}</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center text-wrap">
                            <small class="text-light me-2">Description</small> <strong>{{ $menu->description }}</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center text-wrap">
                            <small class="text-light me-2">Tax</small> <strong>{{ $menu->tax }}</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center text-wrap">
                            <small class="text-light me-2">Calories</small> <strong>{{ $menu->calories }}</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center text-wrap">
                            <small class="text-light me-2">Preparation Time</small> <strong>{{ $menu->preparation_time }}</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center text-wrap">
                            <small class="text-light me-2">{{ __('Walking Minutes to Burn Calories') }}</small> <strong>{{ $menu->walking_minutes_to_burn_calories }}</strong>
                        </li>
                        <li class="list-group-item d-flex align-items-center text-wrap">
                            <small class="text-light me-2">High Salt Content</small>
                            @if( $menu->is_high_salt)
                                <strong class="badge bg-label-danger me-1">Yes</strong>
                            @else
                                <strong class="badge bg-label-success me-1">No</strong>
                            @endif
                        </li>
                        <li class="list-group-item d-flex align-items-center text-wrap">
                            <small class="text-light me-2">Category</small> <strong class="badge bg-label-primary me-1">{{ $menu->category?->name }}</strong>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center text-wrap">
                            <span><small class="text-light me-2">Creator</small> <strong>{{ $menu->creator?->name }}</strong></span>
                            <span><small class="text-light me-2">Editor</small> <strong>{{ $menu->editor?->name }}</strong></span>
                        </li>

                    </ul>
                </div>
            </div>
            <!--/ List group Icons -->

      </div>
  </div>