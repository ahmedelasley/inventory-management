<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Import File Excel</h5>
            <button type="button" class="btn-close" wire:click="closeFormImportExcel" ></button>
        </div>
        <form wire:submit.prevent="importExcel" enctype="multipart/form-data">
            
        <div class="modal-body">

            <div class="mb-3">
                <x-input-label for="file" class="form-label" :value="__('File Excel')" />
                <x-text-input id="file" wire:model.live="file" type="file" class="form-control" :value="old('file')" />
                <x-input-error class="mt-2" :messages="$errors->get('file')" />
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" wire:click="closeFormImportExcel">
            Cancel 
            </button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"  wire:target="importExcel">Import
                <span wire:loading wire:target="importExcel" class="spinner-border spinner-border-sm text-white" role="status">
            </button>

        </div>
        </form>
        </div>
    </div>
</div>