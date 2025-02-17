<div class="d-flex justify-content-between ">
    <h5 class="card-header">Information

        @if(admin()->can('menu-active'))
            <a class="btn btn-sm" href="javascript:void(0);"
                wire:click.prevent="$dispatch('active', { id: {{ $menu->id }} })">
                @if( $menu->is_active)
                    <i class='bx bxs-toggle-left text-success me-1'></i><span class="badge bg-label-success me-1">Active</span>
                @else
                    <i class='bx bx-toggle-right text-danger me-1'></i><span class="badge bg-label-danger me-1">Inactive</span>
                @endif
            </a>
        @endif

    </h5>
    <div class="card-header">

        @if(admin()->can('menu-edit-picture'))
            <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                wire:click.prevent="$dispatch('profileUpdate', { id: {{ $menu->id }} })">
                <i class='bx bx-photo-album me-1'></i> picture
            </a>
        @endif

        @if(admin()->can('menu-edit'))
            <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                wire:click.prevent="$dispatch('menuUpdate', { id: {{ $menu->id }} })">
                <i class="bx bx-edit-alt me-1"></i> Edit
            </a>
        @endif

    </div>
</div>