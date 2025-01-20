

<x-modal name="assign-role-{{$value->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('admin.admins.assign.role',  $value ) }}" class="p-6 text-start">
        @csrf
        @method('patch')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to Assign Role your account?') }}
        </h2>
        <div class="mb-3">
            <x-input-label for="role" class="form-label" :value="__('Role')" />
            @if (count($roles) > 0)
                <select class="border form-control" id="role" name="role">
                    <option value="">{{ __('Select Role') }}</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            @endif
            <x-input-error class="mt-2" :messages="$errors->get('role')" />
        </div>
        
        <div class="mt-6 flex justify-end">
          <x-secondary-button x-on:click="$dispatch('close')">
              {{ __('Cancel') }}
          </x-secondary-button>
          <button type="submit"  class="btn btn-primary btn-sm ms-3">
                Assigned
              @if (session('status') === 'Assigned Role')
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

