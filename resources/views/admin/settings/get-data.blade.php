<div class="col-xl-12">
    <div class="nav-align-top mb-4">
      <ul class="nav nav-pills mb-3 " role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-home" aria-controls="navs-pills-justified-home" aria-selected="true">
            <i class="tf-icons bx bx-home"></i> Home
            {{-- <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-danger">3</span> --}}
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-logo" aria-controls="navs-pills-justified-logo" aria-selected="false">
            <i class="tf-icons bx bx-images"></i> Logo & Favicon
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-justified-backup" aria-controls="navs-pills-justified-backup" aria-selected="false">
            <i class="tf-icons bx bx-data"></i> Backup
          </button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="navs-pills-justified-home" role="tabpanel">
          @livewire('admin.settings.partials.edit')
        </div>
        <div class="tab-pane fade" id="navs-pills-justified-logo" role="tabpanel">
          @livewire('admin.settings.partials.logo')
        </div>
        <div class="tab-pane fade" id="navs-pills-justified-backup" role="tabpanel">
          @livewire('admin.settings.partials.backup')
        </div>
      </div>
    </div>
  </div>