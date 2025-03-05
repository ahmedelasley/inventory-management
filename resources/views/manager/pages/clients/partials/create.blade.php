<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add New Client</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            @csrf
        <div class="modal-body">
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Name')" />
                <x-text-input id="name" wire:model.live.debounce.250ms="name" type="text" class="form-control" autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div class="mb-3">
                <x-input-label for="phone" class="form-label" :value="__('phone')" />
                <x-text-input id="phone" wire:model.live.debounce.250ms="phone" type="text" class="form-control"/>
                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
            </div>
            <div class="mb-3">
                <x-input-label for="email" class="form-label" :value="__('email')" />
                <x-text-input id="email" wire:model.live.debounce.250ms="email" type="email" class="form-control"/>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div class="mb-3">
                <x-input-label for="address" class="form-label" :value="__('Address')" />
                <x-text-input id="address" wire:model.live="address" type="text" class="form-control"  />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
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