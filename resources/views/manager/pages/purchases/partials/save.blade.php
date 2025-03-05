    <!-- Modal -->
    <div  wire:ignore class="modal fade" id="savePurchaseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Save Purchase </h5>
                <button type="button" class="btn-close" wire:click="closeForm" ></button>
            </div>
            <form method="post" wire:submit.prevent="submit">
                @csrf
                <div class="modal-body">   

                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="type" class="form-label">Type</label><span class='text-danger'>*</span>
                            <select wire:model.live.debounce.250ms="type" class="form-control" id="type">
                                {{-- <option value="Draft" wire:key="Draft" >Draft</option> --}}
                                <option value="Purchasing" wire:key="Purchasing" >Purchasing</option>
                                <option value="Return" wire:key="Return" >Return</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('type')" />
                        </div>
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
