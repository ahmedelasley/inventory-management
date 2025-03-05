<div class="row">
            
    <div class="col-md-4">
        <div class="card mb-4">

            @if(manager()->can('menu-show-information'))
                @livewire('manager.pages.menus.partials.title', ['menu' => $menu])
            @endif

            @if(manager()->can('menu-show-information'))
                @livewire('manager.pages.menus.partials.show-information', ['menu' => $menu])
            @endif

            @if(manager()->can('menu-active'))
                @livewire('manager.pages.menus.partials.active')
            @endif

            @if(manager()->can('menu-edit'))
                @livewire('manager.pages.menus.partials.edit')
            @endif


        </div>
 
    </div>

    <div class="col-md-8">
        @if(manager()->can('menu-show-ingredients'))
        <div class="card mb-4">
            <div class="d-flex justify-content-between ">
                <h5 class="card-header">Show Ingredients</h5>
                <div class="card-header">

                    @if(manager()->can('menu-add-ingredients'))
                        <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                            wire:click.prevent="$dispatch('addItem', { id: {{ $menu->id }} })">
                            <i class="bx bx-plus me-1"></i> Add
                        </a>
                        @livewire('manager.pages.menus.partials.create-item')
                    @endif

                </div>
              </div>

            @if(manager()->can('menu-all-ingredients'))
                @livewire('manager.pages.menus.partials.show-ingredients', ['menu' => $menu])
            @endif
        </div>
        @endif
    </div>

</div>