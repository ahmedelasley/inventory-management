<div class="mb-4" wire:ignore.self>
    <form wire:submit.prevent="submit">

    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Bascis App</h5>
      <small class="text-muted float-end">
        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"  wire:target="submit"><i class="tf-icons bx bx-save"></i> Save
            <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm text-white" role="status">
        </button>
    </small>
    </div>
    <div class="card-body">
            <div class="row">
                @foreach ($settings as $key => $value)
                @if ($type[$key] === 0)
                    <div class="col-md-6 mb-3">
                        <label class="form-label"  for="{{ $key }}">{{ ucfirst(str_replace('_', ' ', $key)) }} </label>

                        @if ( isset($data_types[$key]) && $data_types[$key] === 'boolean')

                            <div class="d-flex justify-content-start">
                                <div class="form-check me-3">
                                    <input type="radio" name="{{ $key }}" wire:model.live="settings.{{ $key }}" class="form-check-input" value="0" id="OFF"/>
                                    <label class="form-check-label" for="OFF"> OFF </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="{{ $key }}" wire:model.live="settings.{{ $key }}" class="form-check-input" value="1" id="OFF"/>
                                    <label class="form-check-label" for="On"> On </label>
                                </div>
                            </div>
                        @elseif (isset($data_types[$key]) && $data_types[$key] === 'json')
                            <span class="badge bg-label-primary">Enter values separated by commas ,</span>
                            @php
                                $jsonValues = explode(',', $value) ?? [];
                            @endphp
                            <div class="d-flex justify-content-start">
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control @error('settings.' . $key) border-red-500 @enderror" id="{{ $key }}"  wire:model.live="settings.{{ $key }}" />
                                </div>
                            </div>
                            <div class="demo-inline-spacing">
                                @forelse ($jsonValues as $jsonValue)
                                    <span class="badge bg-primary">{{$jsonValue}}</span>
                                @empty
                                @endforelse
                            </div>

                        @else
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control @error('settings.' . $key) border-red-500 @enderror" id="{{ $key }}"  wire:model.live="settings.{{ $key }}" />
                            </div>
                        @endif
                        <x-input-error class="mt-2 text-danger" :messages="$errors->get('settings.' . $key)" />
                    </div>
                @endif
            @endforeach
            </div>
    </div>
</form>
</div>







