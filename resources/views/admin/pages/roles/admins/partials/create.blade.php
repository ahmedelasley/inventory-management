<!-- Modal -->
<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Role</h5>
                <button type="button" class="btn-close" wire:click="closeForm"></button>
            </div>
            <form method="post" wire:submit.prevent="submit">
                @csrf
                <div class="modal-body">

                    <div class="mb-3">
                        <x-input-label for="name" class="form-label" :value="__('Name')" />
                        <x-text-input id="name" wire:model.defer="name" type="text" class="form-control" required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    <div class="row mb-3">
                        <x-input-label for="name" class="form-label" :value="__('Permission')" />

                        @foreach (\Spatie\Permission\Models\Permission::select('guard_name', 'type', 'type_name')->where('guard_name', 'admin')->groupBy('guard_name', 'type', 'type_name')->get() as $data)
                        <div class="col-md-12 border p-2">
                                <h6 class="mt-2">
                                    <label>
                                        <input class="form-check-input" type="checkbox" wire:click="toggleType('{{ $data->type }}')">
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
                                                <input class="form-check-input" type="checkbox" wire:model.defer="permissions" value="{{ $id }}">
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
                    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                        Save
                        <span wire:loading class="spinner-border spinner-border-sm text-white" role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
