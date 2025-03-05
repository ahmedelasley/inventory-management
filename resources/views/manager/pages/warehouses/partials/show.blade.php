<!-- Modal -->
<div  class="modal fade" id="showModal" tabindex="-1" aria-hidden="true" wire:key="show-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Show Warehouse [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
            
        <div class="modal-body">
            <div class="mb-3">
                <x-text-show :labelValue="__('Code')" :value=$code/>
            </div>
            <div class="mb-3">
                <x-text-show :labelValue="__('Name')" :value=$name/>
            </div>
            <div class="mb-3">
                <x-text-show :labelValue="__('Restaurant')" :value=$restaurant/>
            </div>
            <div class="mb-3">
                <x-text-show :labelValue="__('location')" :value=$location/>
            </div>
            <div class="mb-3">
                <x-text-show :labelValue="__('Supervisor')" :value=$keeper/>
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