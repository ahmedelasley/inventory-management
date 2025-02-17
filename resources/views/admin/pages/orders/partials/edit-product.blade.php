<div >
    <!-- Modal -->
    <div  wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit {{ $name }} [ {{ $sku }} ] </h5>
                <button type="button" class="btn-close" wire:click="closeForm" ></button>
            </div>
            <form method="post" wire:submit.prevent="submit">
                @csrf
                <div class="modal-body">   

                        @if($type == 'Pending')
                            @if(admin()->can('transfer-edit-qty-request-item'))
                                <div class="row g-1">
                                    <div class="col mb-3">
                                        <x-input-label for="quantity_request" class="form-label" :value="__('Quantity Request')" /><span class='text-danger'>*</span>
                                        <x-text-input id="quantity_request" wire:model="quantity_request" type="number" class="form-control" pattern="^\d*(\.\d{0,4})?$"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('quantity_request')" />
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="row g-1">
                                <div class="col mb-3">
                                    <x-text-show class='text-center' :labelValue="__('Quantity Request')" :value="$quantity_request"/> 
                                </div>
                            </div>
                            
                            @if(admin()->can('transfer-edit-qty-send-item'))
                                <div class="row g-1">
                                    <div class="col mb-3">
                                        <x-input-label for="quantity_available" class="form-label" :value="__('Quantity Available')" /><span class='text-danger'>*</span>
                                        <x-text-input id="quantity_available" wire:model="quantity_available" type="number" class="form-control" pattern="^\d*(\.\d{0,4})?$"/>
                                        <x-input-error class="mt-2" :messages="$errors->get('quantity_available')" />
                                    </div>
                                </div>
                            @endif
                        @endif
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
</div>