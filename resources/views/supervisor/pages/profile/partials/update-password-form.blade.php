<div class="card mb-4">
    <h5 class="card-header">{{ __('Update Password') }}</h5>
    <div class="card-body">
        <div class="mb-3 col-12 mb-0">
            <div class="alert alert-warning">
            <h6 class="alert-heading fw-bold mb-1">Are you sure you want to Update Password your account?</h6>
            <p class="mb-0">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
            </div>
        </div>
      
        <form method="post" action="{{ route('supervisor.password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div>
                <x-input-label for="update_password_current_password" class="form-label" :value="__('Current Password')" />
                <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password" class="form-label" :value="__('New Password')" />
                <x-text-input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" class="form-label" :value="__('Confirm Password')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                {{-- <x-primary-button>{{ __('Save') }}</x-primary-button> --}}
                <button type="submit" class="btn btn-primary my-2">
                    Save changes
                    @if (session('status') === 'profile-updated')
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

    </div>
</div>