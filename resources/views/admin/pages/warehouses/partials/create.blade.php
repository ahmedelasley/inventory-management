<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add New Warehouse</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <x-input-label for="name" class="form-label" :value="__('Name')" /><span class='text-danger'>*</span>
                    <x-text-input id="name" wire:model.live.debounce.250ms="name" type="text" class="form-control" autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="mb-3">
                    <x-input-label for="location" class="form-label" :value="__('Location')" />
                    <x-text-input id="location" wire:model.live="location" type="text" class="form-control"  />
                    <x-input-error class="mt-2" :messages="$errors->get('location')" />
                </div>
                <div class="mb-3">
                    <label for="restaurant_id" class="form-label">Restaurant</label><span class='text-danger'>*</span>
                    <select wire:model.live="restaurant_id" class="form-control" id="supervisor_id">
                        <option value="">Select a Restaurant...</option>
                        @forelse ($dataRestaurant as $record)
                            <option value="{{ $record->id }}" wire:key="restaurant-{{ $record->id }}" >{{ $record->name }}</option>
                        @empty
                        @endforelse
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('restaurant_id')" />
                </div>
                <div class="mb-3">
                    <label for="keeper_id" class="form-label">Keepers</label><span class='text-danger'>*</span>
                    <select wire:model.live="keeper_id" class="form-control" id="keeper_id">
                        <option value="">Select a Keeper...</option>
                        @forelse ($dataKeeper as $record)
                            <option value="{{ $record->id }}" wire:key="keeper-{{ $record->id }}" >{{ $record->name }}</option>
                        @empty
                        @endforelse
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('keeper_id')" />
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