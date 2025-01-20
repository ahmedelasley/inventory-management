<div >
    <!-- Modal -->
    <div  wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Edit {{ $name }} [ {{ $sku }} ] </h5>
                <button type="button" class="btn-close" wire:click="closeForm" ></button>
            </div>
            <form method="post" wire:submit.prevent="submit">
                @csrf
                <div class="modal-body">   

                    <div class="row g-3">
                        <div class="col mb-3">
                            <x-input-label for="quantity" class="form-label" :value="__('Quantity')" /><span class='text-danger'>*</span>
                            <x-text-input id="quantity" wire:model="quantity" type="number" class="form-control" pattern="^\d*(\.\d{0,4})?$"/>
                            <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                        </div>
                        <div class="col mb-3">
                            <x-input-label for="cost" class="form-label" :value="__('Cost')" /><span class='text-danger'>*</span>
                            <x-text-input id="cost" wire:model="cost" type="text" class="form-control" step="1" min="0" pattern="^\d+(?:\.\d{12,4})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"/>
                            <x-input-error class="mt-2" :messages="$errors->get('cost')" />
                        </div>
                        <div class="col mb-3">
                            <x-input-label for="total" class="form-label" :value="__('Total')" />
                            <x-text-input id="total" type="text" class="form-control" value="{{ $quantity * $cost  }}" readonly/>
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <x-input-label for="production_date" class="form-label" :value="__('Production Date')" /><span class='text-danger'>*</span>
                            <x-text-input id="production_date" wire:model="production_date" type="date" class="form-control"/>
                            <x-input-error class="mt-2" :messages="$errors->get('production_date')" />
                        </div>

                        <div class="col mb-3">
                            <x-input-label for="expiration_date" class="form-label" :value="__('Expiration Date')" /><span class='text-danger'>*</span>
                            <x-text-input id="expiration_date" wire:model="expiration_date" type="date" class="form-control"/>
                            <x-input-error class="mt-2" :messages="$errors->get('expiration_date')" />
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
</div>