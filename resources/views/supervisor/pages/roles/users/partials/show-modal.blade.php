

<x-modal name="show-{{$value->id}}" :show="$errors->userDeletion->isNotEmpty()" focusable>
  <div class="p-6 text-start">
    <div class="mb-3">
      <x-input-label for="name" class="form-label" :value="__('Name')" />
      <p class="border form-control">{{ $value->name ?? '--' }}</p>
   </div>
    <div class="mb-3 row">
      @if (count($groups) > 0)
        @foreach ($groups as $permission)
          <div class="col-md-6">
            <div class="form-check form-check-primary mt-1">
              <input class="form-check-input" type="checkbox" disabled @checked($value->hasPermissionTo($permission->name))>
              <div class="d-inline-block">
                <label class="form-check-label">{{ $permission->name }}</label>
              </div>
            </div>
          </div>
        @endforeach
      @endif
      
    </div>
    <div class="mt-6 flex justify-end">
      <x-secondary-button x-on:click="$dispatch('close')">
          {{ __('Cancel') }}
      </x-secondary-button>
    </div>
  </div>
</x-modal>

