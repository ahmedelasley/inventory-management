<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="editSaleModal" tabindex="-1" aria-hidden="true" wire:key="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit [ {{ $code }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            <div class="modal-body">   

                <div class="row g-2">
                    <div class="col mb-3">
                        <label for="restaurant_id" class="form-label">Restaurants</label><span class='text-danger'>*</span>
                        <select wire:model.live="restaurant_id" class="form-control" id="restaurant_id">
                            <option value="">Select a Restaurant...</option>
                            @forelse ($restaurants as $record)
                                <option value="{{ $record->id }}" wire:key="restaurant-{{ $record->id }}" >{{ $record->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('restaurant_id')" />
                    </div>
                    
                    <div class="col mb-3">
                        <label for="client_id" class="form-label">Clients</label><span class='text-danger'>*</span>
                        <select wire:model.live="client_id" class="form-control" id="client_id">
                            <option value="">Select a Warehouse...</option>
                            @forelse ($clients as $record)
                                <option value="{{ $record->id }}" wire:key="client-{{ $record->id }}" >{{ $record->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
                    </div>
    
                </div>
                <div class="row g-2">
                    <div class="col mb-3">
                        <x-input-label for="tax" class="form-label" :value="__('Tax')" /><span class='text-danger'>*</span>
                        <x-text-input id="tax" wire:model.blur="tax" type="text" class="form-control"/>
                        <x-input-error class="mt-2" :messages="$errors->get('tax')" />
                    </div>
                    <div class="col mb-3">
                        <x-input-label for="date" class="form-label" :value="__('Invoice Date')" /><span class='text-danger'>*</span>
                        <x-text-input id="date" wire:model.live.debounce.250ms="date" type="date" class="form-control"/>
                        <x-input-error class="mt-2" :messages="$errors->get('date')" />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <x-input-label for="notes" class="form-label" :value="__('Notes')" /><span class='text-danger'>*</span>
                        <x-text-input id="notes" wire:model.live.debounce.250ms="notes" type="text" class="form-control"/>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
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