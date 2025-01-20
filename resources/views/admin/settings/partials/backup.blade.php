<div class="mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Backup App</h5>

    </div>
    <div class="card-body">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label d-block"  for="">Backup Database</label>
                    <button class="btn btn-primary" wire:loading.attr="disabled"  wire:target="backupDatabase" wire:click="backupDatabase"><i class="tf-icons bx bx-data"></i> New Backup Database
                        <span wire:loading wire:target="backupDatabase" class="spinner-border spinner-border-sm text-white" role="status">
                    </button>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label d-block"  for="">Backup Project</label>
                    <button class="btn btn-primary" wire:loading.attr="disabled"  wire:target="backupProject" wire:click="backupProject"><i class="tf-icons bx bx-data"></i> New Backup Project
                        <span wire:loading wire:target="backupProject" class="spinner-border spinner-border-sm text-white" role="status">
                    </button>
                </div>
            </div>
    </div>
</div>

