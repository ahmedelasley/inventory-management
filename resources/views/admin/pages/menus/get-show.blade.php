<div class="row">
            
    <div class="col-md-4">
        <div class="card mb-4">

            @if(admin()->can('menu-show-information'))
                @livewire('admin.pages.menus.partials.title', ['menu' => $menu])
            @endif

            @if(admin()->can('menu-show-information'))
                @livewire('admin.pages.menus.partials.show-information', ['menu' => $menu])
            @endif

            @if(admin()->can('menu-active'))
                @livewire('admin.pages.menus.partials.active')
            @endif

            @if(admin()->can('menu-edit'))
                @livewire('admin.pages.menus.partials.edit')
            @endif


        </div>
 
    </div>

    <div class="col-md-8">
        @if(admin()->can('menu-show-ingredients'))
        <div class="card mb-4">
            <div class="d-flex justify-content-between ">
                <h5 class="card-header">Show Ingredients</h5>
                <div class="card-header">

                    @if(admin()->can('menu-add-ingredients'))
                        <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                            wire:click.prevent="$dispatch('addItem', { id: {{ $menu->id }} })">
                            <i class="bx bx-plus me-1"></i> Add
                        </a>
                        @livewire('admin.pages.menus.partials.create-item')
                    @endif

                </div>
              </div>

            @if(admin()->can('menu-all-ingredients'))
                @livewire('admin.pages.menus.partials.show-ingredients', ['menu' => $menu])
            @endif
        </div>
        @endif
    </div>

</div>