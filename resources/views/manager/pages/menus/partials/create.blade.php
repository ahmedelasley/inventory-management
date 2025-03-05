<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add New Product in Menu</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            @csrf
            <div class="modal-body">
                <div class="row g-2">
                    <div class="col mb-3">
                        <x-input-label for="name" class="form-label" :value="__('Name')" /><span class='text-danger'>*</span>
                        <x-text-input id="name" wire:model.live.debounce.250ms="name" type="text" class="form-control" autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div class="col mb-3">
                        <x-input-label for="name_localized" class="form-label" :value="__('Name Localized')" />
                        <x-text-input id="name_localized" wire:model.live.debounce.250ms="name_localized" type="text" class="form-control" autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name_localized')" />
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <x-input-label for="description" class="form-label" :value="__('Description')" />
                        <x-text-input id="description" wire:model.live="description" type="text" class="form-control"  />
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-3">
                        <x-input-label for="price" class="form-label" :value="__('Price')" /><span class='text-danger'>*</span>
                        <x-text-input id="price" wire:model.live.debounce.250ms="price" type="text" class="form-control"/>
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    <div class="col mb-3">
                        <label for="category_id" class="form-label">Category</label><span class='text-danger'>*</span>
                        <select wire:model.live="category_id" class="form-control" id="category_id">
                            <option value="">Select a Category...</option>
                            @forelse ($categories ?? [] as $cat)
                                <option value="{{ $cat->id }}" wire:key="category-{{ $cat->id }}" >{{ $cat->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                    </div>
                </div>
                <div class="row g-2">

                    <div class="col mb-3">
                        <label for="restaurant_id" class="form-label">Restaurant</label><span class='text-danger'>*</span>
                        <select wire:model.live="restaurant_id" class="form-control" id="restaurant_id">
                            <option value="">Select a Restaurant...</option>
                            @forelse ($restaurants ?? [] as $restaurant)
                                <option value="{{ $restaurant->id }}" wire:key="restaurant-{{ $restaurant->id }}" >{{ $restaurant->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('restaurant_id')" />
                    </div>

                    <div class="col mb-3">
                        <label for="kitchen_id" class="form-label">Kitchen</label><span class='text-danger'>*</span>
                        <select wire:model.live="kitchen_id" class="form-control" id="kitchen_id">
                            <option value="">Select a Kitchen...</option>
                            @forelse ($kitchens ?? [] as $kitchen)
                                <option value="{{ $kitchen->id }}" wire:key="kitchen-{{ $kitchen->id }}" >{{ $kitchen->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('kitchen_id')" />
                    </div>

                </div>

            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" wire:click="closeForm">
                Cancel 
            </button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"  wire:target="submit">Save
                <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm text-white" role="status">
            </button>

        </div>
        </form>
        </div>
    </div>
</div>