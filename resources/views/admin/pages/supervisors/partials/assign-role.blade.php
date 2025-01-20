
<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="assignRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Assign Role [ {{ $name }}]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <x-input-label for="role" class="form-label" :value="__('Role')" />
                        <select class="border form-control" id="role" wire:model="role">
                            <option value="">{{ __('Select Role') }}</option>
                            @forelse (cache('supervisor_roles') as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @empty
                                <p>No Roles</p>
                            @endforelse
                        </select>
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
                </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" wire:click="closeForm">
                Cancel 
            </button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"  wire:target="submit">Assign
                <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm text-white" role="status">
            </button>

        </div>
        </form>
        </div>
    </div>
</div>
