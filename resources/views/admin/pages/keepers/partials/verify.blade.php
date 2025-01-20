<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="verifyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">{{ $email_verified_at ? 'Not Verify' : 'Verify' }} [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            
        <div class="modal-body">

            <h5 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to '. ($email_verified_at ? 'Not Verify' : 'Verify' ).' your Account ?') }}
            </h5>
            <x-show :value=$name/>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" wire:click="closeForm">
                Cancel 
            </button>
            <button type="submit" class="btn btn-warning" wire:loading.attr="disabled"  wire:target="submit">{{ $email_verified_at ? 'Not Verify' : 'Verify' }}
                <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm text-white" role="status">
            </button>

        </div>
        </form>
        </div>
    </div>
</div>