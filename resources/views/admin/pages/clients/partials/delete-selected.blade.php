<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="deleteSelectedModal" tabindex="-1" aria-hidden="true"  >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Delete Selected</h5>
            <button type="button" class="btn-close" wire:click.prevent="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="deleteSelected">
            
        <div class="modal-body">

            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete Selected Clients?') }}
            </h4>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary"wire:click.prevent="closeForm" >
                Cancel 
            </button>
            <button type="submit" class="btn btn-danger" wire:loading.attr="disabled"  wire:target="deleteSelected">Delete
                <span wire:loading wire:target="deleteSelected" class="spinner-border spinner-border-sm text-white" role="status">
            </button>

        </div>
        </form>
        </div>
    </div>
</div>