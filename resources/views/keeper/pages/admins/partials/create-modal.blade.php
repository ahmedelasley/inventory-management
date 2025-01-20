

<button type="button" class="btn btn-primary btn-sm"
x-data=""
x-on:click.prevent="$dispatch('open-modal', 'confirm-user-create')"
>
    <span class="tf-icons bx bx-plus"></span>&nbsp; add
</button>
<x-modal name="confirm-user-create" :show="$errors->userDeletion->isNotEmpty()" focusable>
<form method="post" action="{{ route('admin.admins.store') }}" class="p-6">
    @csrf
    {{-- @method('delete') --}}

    {{-- <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Are you sure you want to delete your account?') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
    </p> --}}
    <div class="mb-3">
        <x-input-label for="name" class="form-label" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="mb-3">
        <x-input-label for="email" class="form-label" :value="__('Email')" />
        <x-text-input id="email" name="email" type="email" class="form-control" :value="old('email')" required autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>
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
            Create
            @if (session('status') === 'Created')
                <i
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                class='bx bx-loader-circle' ></i>
            @endif
        </button>

    </div>
</form>
</x-modal>

