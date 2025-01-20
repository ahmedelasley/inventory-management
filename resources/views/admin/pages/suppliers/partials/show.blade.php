<!-- Modal -->
<div  class="modal fade" id="showModal" tabindex="-1" aria-hidden="true" wire:key="show-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Show Supplier </h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        {{-- <div class="d-flex justify-content-end">
            @if($email_verified_at)
                <span class="badge bg-label-primary mx-5 p-2">Active</span>
            @else
                <span class="badge bg-label-danger mx-5 p-2">Not Active</span>
            @endif
        </div> --}}
        <div class="modal-body">
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Name')" />
                <x-show :value=$name/>
            </div>
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Code')" />
                <x-show :value=$code/>
            </div>
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Phone')" />
                <x-show :value=$phone/>
            </div>
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Email')" />
                <x-show :value=$email/>
            </div>
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Address')" />
                <x-show :value=$address/>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" wire:click="closeForm">
            Close 
            </button>
        </div>
        </div>
    </div>
</div>