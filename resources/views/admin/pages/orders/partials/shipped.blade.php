    <!-- Modal -->
    <div  wire:ignore class="modal fade" id="shippedOrderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Shipped Order </h5>
                <button type="button" class="btn-close" wire:click="closeForm" ></button>
            </div>
            <form method="post" wire:submit.prevent="submit">
                @csrf
                <div class="modal-body">   

                    <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Are you sure you want to Shipped your Order to Kitchen?') }}
                    </h4>
                    <input id="name"  type="text" class="form-control" wire:model.live="code"readonly  />
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" wire:click="closeForm">
                        Cancel 
                    </button>
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"  wire:target="submit">Shipped
                        <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm text-white" role="status">
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>
