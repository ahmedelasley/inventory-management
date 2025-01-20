<!-- Modal -->
<div  class="modal fade" id="showModal" tabindex="-1" aria-hidden="true" wire:key="show-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Show Product [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
            
        <div class="modal-body">
            <div class="row g-2">
                <div class="col mb-3">
                    <x-text-show :labelValue="__('Name')" :value=$name/>
                </div>
                <div class="col mb-3">
                    <x-text-show :labelValue="__('Name Localized')" :value=$name_localized/>
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-3">
                    <x-text-show :labelValue="__('SKU')" :value=$sku/>
                </div>
                <div class="col mb-3">
                    <x-text-show :labelValue="__('Category')" :value=$category/>
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-3">
                    <x-text-show :labelValue="__('Description')" :value=$description/>
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-3">
                    <x-text-show :labelValue="__('Storge Unit')" :value=$storge_unit/>
                </div>
                <div class="col mb-3">
                    <x-text-show :labelValue="__('Intgredtiant Unit')" :value=$intgredtiant_unit/>
                </div>
            </div>
            <div class="row g-2">
                <div class="col mb-3">
                    <x-text-show :labelValue="__('Storage to Intgredient')" :value=$storage_to_intgredient/>
                </div>
                <div class="col mb-3">
                    <x-text-show :labelValue="__('Costing Method')" :value=$costing_method/>
                </div>
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