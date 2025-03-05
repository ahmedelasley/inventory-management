<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add New Order</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form method="post" wire:submit.prevent="submit">
            @csrf
            <div class="modal-body">   
                <div class="mb-3">
                    <label for="kitchen_id" class="form-label">Kitchens</label><span class='text-danger'>*</span>
                    <select wire:model.live="kitchen_id" class="form-control" id="kitchen_id">
                        <option value="">Select a Kitchen...</option>
                    
                        @if(!empty($restaurants))
                            @foreach ($restaurants as $record)
                                @if(!empty($record->kitchens))
                                    <optgroup label="{{ $record->name }} Restaurant">
                                        @foreach ($record->kitchens as $kitchen)
                                            <option value="{{ $kitchen->id }}">{{ $kitchen->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            @endforeach
                        @else
                            <option disabled>No Restaurants Available</option>
                        @endif
                    </select>
                    
                    <x-input-error class="mt-2" :messages="$errors->get('kitchen_id')" />
                </div>
                <div class="mb-3">
                    <label for="warehouse_id" class="form-label">Warehouses</label><span class='text-danger'>*</span>
                    <select wire:model.live="warehouse_id" class="form-control" id="warehouse_id">
                        <option value="">Select a Warehouse...</option>
                        @forelse ($restaurants as $record)
                            <optgroup label="{{ $record->name }} Restaurant">
                                @forelse ($record->warehouses as $kitchen)
                                    <option value="{{ $kitchen->id }}" wire:key="kitchen-{{ $kitchen->id }}">
                                        {{ $kitchen->name }}
                                    </option>
                                @empty
                                    <option disabled>No Warehouses</option>
                                @endforelse
                            </optgroup>
                        @empty
                        @endforelse
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('warehouse_id')" />
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