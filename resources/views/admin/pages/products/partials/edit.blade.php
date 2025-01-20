<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" wire:key="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Product [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form wire:submit.prevent="submit">
            
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
            <div class="row g-2">
                <div class="col mb-3">
                    <x-input-label for="description" class="form-label" :value="__('Description')" />
                    <x-text-input id="description" wire:model.live="description" type="text" class="form-control"  />
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>


                <div class="col mb-3">
                    <label for="category_id" class="form-label">Category</label><span class='text-danger'>*</span>
                    <select wire:model.live="category_id" class="form-control" id="category_id">
                        <option value="">Select a Category...</option>
                        @forelse ($data as $cat)
                            <option value="{{ $cat->id }}" wire:key="category-{{ $cat->id }}" >{{ $cat->name }}</option>
                        @empty
                        @endforelse
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-3">
                    <x-input-label for="storge_unit" class="form-label" :value="__('Storge Unit')" /><span class='text-danger'>*</span>
                    <x-text-input id="storge_unit" wire:model.live.debounce.250ms="storge_unit" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('storge_unit')" />
                </div>
                <div class="col mb-3">
                    <x-input-label for="intgredtiant_unit" class="form-label" :value="__('Intgredtiant Unit')" /><span class='text-danger'>*</span>
                    <x-text-input id="intgredtiant_unit" wire:model.live.debounce.250ms="intgredtiant_unit" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('intgredtiant_unit')" />
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-3">
                    <x-input-label for="storage_to_intgredient" class="form-label" :value="__('Storage to Intgredient')" /><span class='text-danger'>*</span>
                    <x-text-input id="storage_to_intgredient" wire:model.live.debounce.250ms="storage_to_intgredient" type="text" class="form-control"/>
                    <x-input-error class="mt-2" :messages="$errors->get('storage_to_intgredient')" />
                </div>


                <div class="col mb-3">
                    <x-input-label for="costing_method" class="form-label" :value="__('Costing Method')" /><span class='text-danger'>*</span>
                    <select wire:model.live="costing_method" class="form-control" id="costing_method">
                        <option value="">Select a Category...</option>
                        <option value="Fixed">Fixed</option>
                        <option value="From Transactions">From Transactions</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('costing_method')" />
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