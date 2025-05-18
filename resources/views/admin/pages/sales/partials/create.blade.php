<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add New Sale</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            @csrf
            <div class="modal-body">   
                <div class="mb-3">
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
                <div class="mb-3">
                    <label for="client_id" class="form-label">Clients</label><span class='text-danger'>*</span>
                    <select wire:model.live="client_id" class="form-control" id="client_id">
                        <option value="">Select a Client...</option>
                        @forelse ($clients as $record)
                            <option value="{{ $record->id }}" wire:key="client-{{ $record->id }}" >{{ $record->name }}</option>
                        @empty
                        @endforelse
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('client_id')" />
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