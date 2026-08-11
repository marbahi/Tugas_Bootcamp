<section>
    <header class="mb-4">
        <h2 class="font-display fw-bold fs-5 mb-1">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-muted small mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn btn-danger btn-pill" data-bs-toggle="modal" data-bs-target="#confirmUserDeletion">
        {{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirmUserDeletion" tabindex="-1" aria-labelledby="confirmUserDeletionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-display fw-bold" id="confirmUserDeletionLabel">
                        {{ __('Are you sure you want to delete your account?') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body">
                        <p class="text-muted small">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div>
                            <x-input-label for="password" value="{{ __('Password') }}" />

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                placeholder="{{ __('Password') }}"
                                autocomplete="current-password"
                            />

                            <x-input-error :messages="$errors->userDeletion->get('password')" />
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary btn-pill" data-bs-dismiss="modal">
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