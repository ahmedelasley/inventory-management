<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="editPurchaseModal" tabindex="-1" aria-hidden="true" wire:key="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit [ {{ $code }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            <div class="modal-body">   

                <div class="row g-2">
                    <div class="col mb-3">
                        <label for="supplier_id" class="form-label">Suppliers</label><span class='text-danger'>*</span>
                        <select wire:model.live.debounce.250ms="supplier_id" class="form-control" id="supplier_id">
                            <option value="">Select a Supplier...</option>
                            @forelse ($suppliers as $record)
                                <option value="{{ $record->id }}" wire:key="supplier-{{ $record->id }}" >{{ $record->name }}</option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('supplier_id')" />
                    </div>
                    <div class="col mb-3">
                    <label for="warehouse_id" class="form-label">Warehouses</label><span class='text-danger'>*</span>
                    <select wire:model.live.debounce.250ms="warehouse_id" class="form-control" id="warehouse_id">
                        <option value="">Select a Warehouse...</option>
                        @forelse ($warehouses as $record)
                            <option value="{{ $record->id }}" wire:key="warehouse-{{ $record->id }}" >{{ $record->name }}</option>
                        @empty
                        @endforelse
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('warehouse_id')" />
                    </div>
                </div>

                <div class="row g-2">
                    <div class="col mb-3">
                        <x-input-label for="invoice_date" class="form-label" :value="__('Invoice Date')" /><span class='text-danger'>*</span>
                        <x-text-input id="invoice_date" wire:model.live.debounce.250ms="invoice_date" type="date" class="form-control"/>
                        <x-input-error class="mt-2" :messages="$errors->get('invoice_date')" />
                    </div>

                    <div class="col mb-3">
                        <x-input-label for="invoice_number" class="form-label" :value="__('Invoice Number')" /><span class='text-danger'>*</span>
                        <x-text-input id="invoice_number" wire:model.live.debounce.250ms="invoice_number" type="text" class="form-control"/>
                        <x-input-error class="mt-2" :messages="$errors->get('invoice_number')" />
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col mb-3">
                        <x-input-label for="additional_cost" class="form-label" :value="__('Additional Cost')" /><span class='text-danger'>*</span>
                        <x-text-input id="additional_cost" wire:model.blur="additional_cost" type="text" class="form-control" step="1" min="0" pattern="^\d+(?:\.\d{12,4})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"/>
                        <x-input-error class="mt-2" :messages="$errors->get('additional_cost')" />
                    </div>
                    <div class="col mb-3">
                        <x-input-label for="tax" class="form-label" :value="__('Paid Tax')" /><span class='text-danger'>*</span>
                        <x-text-input id="tax" wire:model.blur="tax" type="text" class="form-control" step="1" min="0" pattern="^\d+(?:\.\d{12,4})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"/>
                        <x-input-error class="mt-2" :messages="$errors->get('tax')" />
                    </div>
                    <div class="col mb-3">
                        <x-input-label for="discount" class="form-label" :value="__('Discount')" /><span class='text-danger'>*</span>
                        <x-text-input id="discount" wire:model.blur="discount" type="text" class="form-control" step="1" min="0" pattern="^\d+(?:\.\d{12,4})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'"/>
                        <x-input-error class="mt-2" :messages="$errors->get('discount')" />
                    </div>

                </div>
                <div class="row">
                    <div class="col mb-3">
                        <x-input-label for="notes" class="form-label" :value="__('Notes')" /><span class='text-danger'>*</span>
                        <x-text-input id="notes" wire:model.live.debounce.250ms="notes" type="text" class="form-control"/>
                        <x-input-error class="mt-2" :messages="$errors->get('notes')" />
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