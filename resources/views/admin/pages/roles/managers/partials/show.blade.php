<!-- Modal -->
<div  class="modal fade" id="showModal" tabindex="-1" aria-hidden="true" wire:key="show-modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Show Role [ {{ $name }} ]</h5>
            <button type="button" class="btn-close" wire:click="closeForm" ></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <x-input-label for="name" class="form-label" :value="__('Name')" />
                <x-show :value=$name/>
            </div>
            <div class="row mb-3">
                <x-input-label for="name" class="form-label" :value="__('Permission')" />

                @foreach (\Spatie\Permission\Models\Permission::select('guard_name', 'type', 'type_name')->where('guard_name', 'manager')->groupBy('guard_name', 'type', 'type_name')->get() as $data)
                    <div class="col-md-12 border p-2">
                        <h6 class="mt-2">
                            <label>
                                {{-- <input class="form-check-input" type="checkbox" wire:click="toggleType('{{ $data->type }}')"> --}}
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
                                        <input class="form-check-input" type="checkbox" wire:model.defer="permissions"@if(in_array($id, $permissions)) checked @endif value="{{ $id }}" disabled>
                                        {{ \Illuminate\Support\Str::title(str_replace('-', ' ', $value)) }}
                                        
                                    </label>
                                    <br/>
                                </div>
                            @endforeach
                        </div> 
                    </div>
                @endforeach

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