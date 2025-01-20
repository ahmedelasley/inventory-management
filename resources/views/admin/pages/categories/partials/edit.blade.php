<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" wire:key="edit-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form wire:submit.prevent="submit">
            
        <div class="modal-body">
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Name')" />
                <x-text-input id="name" wire:model.defer="name" type="text" class="form-control" autofocus placeholder="Enter your value here"  />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div class="mb-3">
                <x-input-label for="description" class="form-label" :value="__('Description')" />
                <x-text-input id="description" wire:model.live="description" type="text" class="form-control" :value="old('description')" />
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>
            <div class="mb-3">
            <label for="parent_id" class="form-label">Parent Category</label>
            <select wire:model.live="parent_id" class="form-control" id="parent_id">
                <option disabled value="">Select a Category...</option>
                <option value="0">None</option>
                @forelse ($data as $cat)
                    <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @empty
                @endforelse
            </select>
            {{-- <x-input-error class="mt-2" :messages="$errors->get('parent_id')" /> --}}

            <div>@error('parent_id') {{ $message }} @enderror</div>
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