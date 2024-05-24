<x-auth.form-section submit="updatePassword">
  <x-slot name="title">
    {{ __('Update Password') }}
  </x-slot>

  <x-slot name="description">
    {{ __('Ensure your account is using a long, random password to stay secure.') }}
  </x-slot>

  <x-slot name="form">
    <div class="mb-3">
      <x-auth.label class="form-label" for="current_password" value="{{ __('Current Password') }}" />
      <x-auth.input id="current_password" type="password"
        class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}" wire:model="state.current_password"
        autocomplete="current-password" />
      <x-auth.input-error for="current_password" />
    </div>

    <div class="mb-3">
      <x-auth.label class="form-label" for="password" value="{{ __('New Password') }}" />
      <x-auth.input id="password" type="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
        wire:model="state.password" autocomplete="new-password" />
      <x-auth.input-error for="password" />
    </div>

    <div class="mb-3">
      <x-auth.label class="form-label" for="password_confirmation" value="{{ __('Confirm Password') }}" />
      <x-auth.input id="password_confirmation" type="password"
        class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
        wire:model="state.password_confirmation" autocomplete="new-password" />
      <x-auth.input-error for="password_confirmation" />
    </div>
  </x-slot>

  <x-slot name="actions">
    <x-auth.button>
      {{ __('Save') }}
    </x-auth.button>
  </x-slot>
</x-auth.form-section>
