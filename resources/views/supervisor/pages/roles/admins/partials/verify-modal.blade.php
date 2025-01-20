

<x-modal name="verify-{{$value->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('admin.admins.verify',  $value ) }}" class="p-6 text-start">
        @csrf
        @method('patch')

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to verify your account?') }}
        </h2>

        <div class="mt-6 flex justify-end">
          <x-secondary-button x-on:click="$dispatch('close')">
              {{ __('Cancel') }}
          </x-secondary-button>
          <button type="submit"  class="btn btn-success btn-sm ms-3">
                Verified
              @if (session('status') === 'Verified')
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

