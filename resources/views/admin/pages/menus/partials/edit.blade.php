<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" wire:key="edit-modal">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Product [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form wire:submit.prevent="submit">
            
        <div class="modal-body">
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
            <div class="row g-2">
                <div class="col mb-3">
                    <x-input-label for="description" class="form-label" :value="__('Description')" />
                    <x-text-input id="description" wire:model.live="description" type="text" class="form-control"  />
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>
                <div class="col mb-3">
                    <x-input-label for="description_localized" class="form-label" :value="__('Description Localized')" />
                    <x-text-input id="description_localized" wire:model.live="description_localized" type="text" class="form-control"  />
                    <x-input-error class="mt-2" :messages="$errors->get('description_localized')" />
                </div>
            </div>

            <div class="row g-2">
                <div class="col mb-3">
                    <x-input-label for="barcode" class="form-label" :value="__('Barcode')" /><span class='text-danger'>*</span>
                    <x-text-input id="barcode" wire:model.live.debounce.250ms="barcode" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('barcode')" />
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
                    <x-input-label for="price" class="form-label" :value="__('Price')" /><span class='text-danger'>*</span>
                    <x-text-input id="price" wire:model.live.debounce.250ms="price" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                </div>
                <div class="col mb-3">
                    <x-input-label for="tax" class="form-label" :value="__('Tax')" /><span class='text-danger'>*</span>
                    <x-text-input id="tax" wire:model.live.debounce.250ms="tax" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('tax')" />
                </div>
            </div>
            <div class="row g-3">
                <div class="col mb-3">
                    <x-input-label for="calories" class="form-label" :value="__('Calories')" /><span class='text-danger'>*</span>
                    <x-text-input id="calories" wire:model.live.debounce.250ms="calories" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('calories')" />
                </div>
                <div class="col mb-3">
                    <x-input-label for="preparation_time" class="form-label" :value="__('Preparation Time')" /><span class='text-danger'>*</span>
                    <x-text-input id="preparation_time" wire:model.live.debounce.250ms="preparation_time" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('preparation_time')" />
                </div>
                <div class="col mb-3">
                    <x-input-label for="walking_minutes_to_burn_calories" class="form-label" :value="__('Walking Minutes to Burn Calories')" /><span class='text-danger'>*</span>
                    <x-text-input id="walking_minutes_to_burn_calories" wire:model.live.debounce.250ms="walking_minutes_to_burn_calories" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('walking_minutes_to_burn_calories')" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" wire:click="closeForm">
            Cancel 
            </button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"  wire:target="submit">Update
                <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm text-white" role="status">
            </button>

        </div>
        </form>
        </div>
    </div>
</div>