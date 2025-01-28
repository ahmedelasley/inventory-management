

<button type="button" class="btn btn-primary btn-sm"
x-data=""
x-on:click.prevent="$dispatch('open-modal', 'confirm-user-create')"
>
    <span class="tf-icons bx bx-plus"></span>&nbsp; add
</button>
<x-modal name="confirm-user-create" :show="$errors->userDeletion->isNotEmpty()" focusable>
<form method="post" action="{{ route('admin.users-roles.store') }}" class="p-6">
    @csrf

    <div class="mb-3">
        <x-input-label for="name" class="form-label" :value="__('Name')" />
        <x-text-input id="name" name="name" type="text" class="form-control" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="row mb-3">

      <strong>Permission:</strong>

      <br/>

      @if (count($groups) > 0)
        @foreach ($groups as $permission)
          <div class="col-md-6">
            <div class="form-check form-check-primary mt-1">
              <input class="form-control" type="checkbox" name="permissionArray[{{ $permission->name }}]" id="formCheckcolor{{ $permission->id }}">
              <label class="form-label" for="formCheckcolor{{ $permission->id }}">{{ $permission->name }}</label>
              
            </div>
          </div>
        @endforeach
      @endif










        <x-input-error class="mt-2" :messages="$errors->get('permissionArray')" />
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
                    {{-- class="text-sm text-gray-600 dark:text-gray-400" --}}
                class='bx bx-loader-circle' ></i>
            @endif
        </button>

    </div>

    @if (session('status') === 'Created')
    <div
    class="bs-toast toast toast-placement-ex m-2"
    role="alert"
    aria-live="assertive"
    aria-atomic="true"
    data-delay="2000"
  >
    <div class="toast-header">
      <i class="bx bx-bell me-2"></i>
      <div class="me-auto fw-semibold">Bootstrap in</div>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.</div>
  </div>
@endif
</form>
</x-modal>
