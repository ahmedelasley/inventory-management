<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add New Product</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            @csrf
            <div class="modal-body">

                <div class="mb-3">
                    <x-input-label for="name" class="form-label" :value="__('Name')" />
                    <x-text-input id="name" wire:model.live.debounce.250ms="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
            
                <div class="mb-3">
                    <x-input-label for="email" class="form-label" :value="__('Email')" />
                    <x-text-input id="email" wire:model.live.debounce.250ms="email" type="email" class="form-control" :value="old('email')" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
                </div>

                <div class="mb-3">
                    <x-input-label for="role" class="form-label" :value="__('Role')" />
                    @if (count($roles) > 0)
                        <select class="border form-control" id="role" wire:model.live.debounce.250ms="role">
                            <option value="">{{ __('Select Role') }}</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    @endif
                    <x-input-error class="mt-2" :messages="$errors->get('role')" />
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