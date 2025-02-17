<!-- Modal -->
<div  wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" aria-hidden="true" wire:key="edit-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Edit Role [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <form wire:submit.prevent="submit">
            
        <div class="modal-body">
            
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Name')" />
                <x-text-input id="name" wire:model.live="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        
            <div class="row mb-3">
                <x-input-label for="name" class="form-label" :value="__('Permission')" />

                @foreach (\Spatie\Permission\Models\Permission::select('guard_name', 'type', 'type_name')->where('guard_name', 'manager')->groupBy('guard_name', 'type', 'type_name')->get() as $data)
                    <div class="col-md-12 border p-2">
                        <h6 class="mt-2">
                            <label>
                                <input class="form-check-input" type="checkbox" wire:click="toggleType('{{ $data->type }}')">
                                {{-- {{ $data->type_name }} --}}
                                {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $data->type_name)) }}
                            </label>
                        </h6>

                        <div class="row">
                            @php
                                $permissionsPluck = $groups->where('type', $data->type);
                            @endphp
                            @foreach($permissionsPluck->pluck('name', 'id')->all() as $id => $value)
                                <div class="col-xs-4 col-sm-4 col-md-3 mt-1">
                                    <label>
                                        <input class="form-check-input" type="checkbox" wire:model.defer="permissions"@if(in_array($id, $permissions)) checked @endif value="{{ $id }}">
                                        {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $value)) }}
                                        
                                    </label>
                                    <br/>
                                </div>
                            @endforeach
                        </div> 
                    </div>
                @endforeach
                <x-input-error class="mt-2" :messages="$errors->get('permissions')" />

            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" wire:click="closeForm">
            Cancel 
            </button>
            <button type="submit" class="btn btn-primary" wire:loading.attr="disabled"  wire:target="submit">Update
                <span wire:loading wire:target="submit" class="spinner-border spinner-border-sm text-white" role="status">
            </button>

        </div>
        </form>
        </div>
    </div>
</div>