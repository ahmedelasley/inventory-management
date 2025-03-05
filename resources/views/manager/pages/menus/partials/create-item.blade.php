<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="createItemModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Add item in Ingredients {{ $menu?->name}}</h5>
                <button type="button" class="btn-close" wire:click="closeForm" ></button>
            </div>
            <form method="post" wire:submit.prevent="submit">
                @csrf
                <div class="modal-body">

                    <div class="row g-1">
                        <div class="col mb-3">
                            <label for="product_id" class="form-label">Item</label><span class='text-danger'>*</span>
                            <select wire:model.live="product_id" class="form-control" id="product_id">
                                <option value="">Select a Item...</option>
                                @forelse ($items as $cat)
                                    <option value="{{ $cat?->id }}" wire:key="product-{{ $cat?->id }}" >{{ $cat?->name }} {{ $cat?->id }}</option>
                                @empty
                                @endforelse
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('product_id')" />
                        </div>
                    </div>
                    <div class="row  g-2">
                        <div class="col mb-3">
                            <x-input-label for="quantity" class="form-label" :value="__('Qty')" /><span class='text-danger'>*</span>
                            <x-text-input id="quantity" wire:model.live.debounce.250ms="quantity" type="text" class="form-control"/>
                            <x-input-error class="mt-2" :messages="$errors->get('quantity')" />
                        </div>
                        {{-- <div class="col mb-3">
                            <x-input-label for="cost" class="form-label" :value="__('Cost')" /><span class='text-danger'>*</span>
                            <x-text-input id="cost" wire:model.live.debounce.250ms="cost" type="text" class="form-control" @readonly(true)/>
                            <x-input-error class="mt-2" :messages="$errors->get('cost')" />
                        </div> --}}

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