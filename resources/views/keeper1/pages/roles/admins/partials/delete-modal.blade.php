

<x-modal name="delete-{{$value->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('admin.admins-roles.destroy',  $value ) }}" class="p-6 text-start">
        @csrf
        @method('delete')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to delete your account?') }}
        </h2>

        {{-- <div class="mt-6">
            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

            <x-text-input
                id="password"
                name="password"
                type="password"
                class="mt-1 block w-3/4"
                placeholder="{{ __('Password') }}"
            />

            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div> --}}

        <div class="mt-6 flex justify-end">
          <x-secondary-button x-on:click="$dispatch('close')">
              {{ __('Cancel') }}
          </x-secondary-button>
          <button type="submit"  class="btn btn-danger btn-sm ms-3">
              Delete
              @if (session('status') === 'Deleted')
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

