<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" wire:key="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Restaurant [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form wire:submit.prevent="submit">
            
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
                    <label for="manager_id" class="form-label">Manager</label><span class='text-danger'>*</span>
                    <select wire:model.live="manager_id" class="form-control" id="manager_id">
                        <option value="">Select a Manager...</option>
                        @forelse ($data as $record)
                            <option value="{{ $record->id }}" wire:key="manager-{{ $record->id }}" >{{ $record->name }}</option>
                        @empty
                        @endforelse
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('manager_id')" />
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