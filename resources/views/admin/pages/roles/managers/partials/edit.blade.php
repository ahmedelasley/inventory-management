<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" wire:key="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Role [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form wire:submit.prevent="submit">
            
        <div class="modal-body">
            
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Name')" />
                <x-text-input id="name" wire:model.live="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        
            <div class="row mb-3">
        
              <strong>Permission:</strong>
        
              <br/>
        
              @if (count($groups) > 0)
                @foreach ($groups as $key => $permission)
                  <div class="col-md-6">
                    <div class=" mt-1">
                        <label>
                            <input class="form-check-input" wire:model.live='permissions' type="checkbox" @if(in_array($permission->id, $permissions)) checked @endif value="{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                      
                    </div>
                  </div>
                @endforeach
              @endif
        
                <x-input-error class="mt-2" :messages="$errors->get('permissions')" />
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