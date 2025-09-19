<section class="mb-4">
    <header class="mb-2">
        <h2 class="h5 fw-medium text-white mb-1">
            {{ __('Delete Account') }}
        </h2>

        <p class="small text-gray-400 mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        type="button"
        data-bs-toggle="modal"
        data-bs-target="#confirm-user-deletion"
    >{{ __('Delete Account') }}</x-danger-button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-primary-light">
                <div class="modal-header">
                    <h5 class="modal-title text-white" id="confirm-user-deletion-label">{{ __('Are you sure you want to delete your account?') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('profile.destroy') }}" class="p-3">
                    @csrf
                    @method('delete')

                    <p class="small text-gray-400 mb-0">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>

                    <div class="mt-3">
                        <x-input-label for="password" value="{{ __('Password') }}" class="visually-hidden" />

                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            class="mt-1 w-75"
                            placeholder="{{ __('Password') }}"
                        />

                        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-3 d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancel') }}
                        </button>

                        <x-danger-button>
                            {{ __('Delete Account') }}
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>