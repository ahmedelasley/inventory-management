

  <x-modal name="edit-{{$value->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
      <form method="post" action="{{ route('admin.admins-roles.update', $value) }}" class="p-6 text-start">
          @csrf
          @method('patch')
          <div class="mb-3">
            <x-input-label for="name" class="form-label" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name', $value->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
    
        <div class="mb-3 row">
            @if (count($groups) > 0)
            @foreach ($groups as $permission)
              <div class="col-md-6">
                <div class="form-check form-check-primary mt-1">
                  <input class="form-control" type="checkbox" name="permissionArray[{{ $permission->name }}]" @checked($value->hasPermissionTo($permission->name)) id="formCheckcolor{{ $permission->id }}">
                  <label class="form-label" for="formCheckcolor{{ $permission->id }}">{{ $permission->name }}</label>
                  
                </div>
              </div>
            @endforeach
          @endif
        </div>

          <div class="mt-6 flex justify-end">
            <x-secondary-button x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </x-secondary-button>
            <button type="submit"  class="btn btn-primary btn-sm ms-3">
                Update
                @if (session('status') === 'Updated')
                    <i
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        {{-- class="text-sm text-gray-600 dark:text-gray-400" --}}
                    class='bx bx-loader-circle' ></i>
                @endif
            </button>
          </div>
      </form>
  </x-modal>

