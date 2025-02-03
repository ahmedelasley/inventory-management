<div class="card mb-4">
      <div class="d-flex justify-content-between ">
        <h5 class="card-header">Profile Information</h5>
        <div class="card-header">
            <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                wire:click.prevent="$dispatch('profileUpdate', { id: {{ $profile->id }} })">
                <i class="bx bx-edit-alt me-1"></i> Edit
            </a>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex flex-column align-items-start align-items-sm-center gap-4">
            <div>
                <img src="https://placehold.co/10x10/696cff/ffffff?font=roboto&text={{ getInitials($profile->name) }}" alt="user-avatar" class="d-block rounded-circle" height="300" width="300" id="uploadedAvatar" />
            </div>
            <div class="button-wrapper text-center">
              <h2 class="card-title">{{ $profile->name }}</h2>
              <h4 class="text-muted my-0">{{ $profile->email }}</h4>
              <h6 class="text-primary mb-0">
                @if ($profile->getRoleNames()->isNotEmpty())
                    @foreach ($profile->getRoleNames() as $role)
                        <span class="badge bg-warning text-white m-1 p-2">
                            {{ $role }}
                        </span>
                    @endforeach
                @endif

              </h6>
            </div>
        </div>
    </div>

</div>


