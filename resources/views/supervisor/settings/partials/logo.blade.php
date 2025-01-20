<div class="mb-4" wire:ignore.self>
    <form wire:submit.prevent="submit">

    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Logo & Favicon App</h5>
      <small class="text-muted float-end">
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"  wire:target="submit"><i class="tf-icons bx bx-save"></i> Save
            <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm text-white" role="status">
        </button>
    </small>
    </div>
    <div class="card-body">

            <div class="row">
                @foreach ($settings as $key => $value)
                    @if ($type[$key] === 1)
                        <div class="col-md-6 mb-3">
                            <label class="form-label"  for="{{ $key }}">{{ ucfirst(str_replace('_', ' ', $key)) }} </label>
    
                            <div class="input-group input-group-merge">
                                <input type="file" class="form-control @error('settings.' . $key) border-red-500 @enderror" id="{{ $key }}"  wire:model="settings.{{ $key }}" />
                            </div>
                            
                            <x-input-error class="mt-2 text-danger" :messages="$errors->get('settings.' . $key)" />
                            @if ($settings[$key]  && $settings[$key] instanceof \Livewire\TemporaryUploadedFile)
                                <img src="{{ $settings[$key]->temporaryUrl() }}"
                                    alt="Preview" 
                                    class="img-thumbnail mt-2" 
                                    style="max-width: 100%;">
                            @endif
                        </div>
                    @endif
                @endforeach
            </div>
    </div>
</form>
</div>

