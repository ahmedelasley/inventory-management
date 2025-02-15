<div class="row">
            
    <div class="col-md-4">
        <div class="card mb-4">

            @livewire('admin.pages.menus.partials.title', ['menu' => $menu])
            @livewire('admin.pages.menus.partials.show-information', ['menu' => $menu])
            @livewire('admin.pages.menus.partials.active')
            @livewire('admin.pages.menus.partials.edit')

        </div>
 
    </div>

    <div class="col-md-8">
        <div class="card mb-4">
            <div class="d-flex justify-content-between ">
                <h5 class="card-header">Show Ingredients</h5>
                <div class="card-header">
                    <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                        wire:click.prevent="$dispatch('addItem', { id: {{ $menu->id }} })">
                        <i class="bx bx-plus me-1"></i> Add
                    </a>
                    @livewire('admin.pages.menus.partials.create-item')
                </div>
              </div>
          @livewire('admin.pages.menus.partials.show-ingredients', ['menu' => $menu])
        </div>
    </div>

</div>