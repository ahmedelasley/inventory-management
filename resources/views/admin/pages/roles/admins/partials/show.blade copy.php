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

                <br/>
        
              @if (count($groups) > 0)
                @foreach ($groups as $key => $permission)
                  <div class="col-md-6">
                    <div class=" mt-1">
                        <label>
                            <input class="form-check-input" wire:model.live='permissions' type="checkbox" @if(in_array($permission->id, $permissions)) checked @endif value="{{ $permission->id }}" disabled >
                            {{ $permission->name }}
                        </label>
                      
                    </div>
                  </div>
                @endforeach
              @endif

            </div>

            
            <div class="row mb-3">
                <x-input-label for="name" class="form-label" :value="__('Permission')" />

                @foreach (\Spatie\Permission\Models\Permission::select('type', 'type_name')->groupBy('type', 'type_name')->get() as $data)
                    <div class="col-md-12 border p-2">
                        <h6 class="mt-2">
                            <label>
                                {{-- <input class="form-check-input" type="checkbox" wire:click="toggleType('{{ $data->type }}')"> --}}
                                {{ $data->type_name }}
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
                                        {{ $value }}
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
            Close 
            </button>
        </div>
        </div>
    </div>
</div>