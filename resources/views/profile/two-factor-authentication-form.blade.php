<x-auth.action-section>
  <x-slot name="title">
    {{ __('Two Factor Authentication') }}
  </x-slot>

  <x-slot name="description">
    {{ __('Add additional security to your account using two factor authentication.') }}
  </x-slot>

  <x-slot name="content">
    <h6>
      @if ($this->enabled)
        @if ($showingConfirmation)
          {{ __('You are enabling two factor authentication.') }}
        @else
          {{ __('You have enabled two factor authentication.') }}
        @endif
      @else
        {{ __('You have not enabled two factor authentication.') }}
      @endif
    </h6>

    <p class="card-text">
      {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
    </p>

    @if ($this->enabled)
      @if ($showingQrCode)
        <p class="card-text mt-2">
          @if ($showingConfirmation)
            {{ __('Scan the following QR code using your phone\'s authenticator application and confirm it with the generated OTP code.') }}
          @else
            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
          @endif
        </p>

        <div class="mt-2">
          {!! $this->user->twoFactorQrCodeSvg() !!}
        </div>

        <div class="mt-4">
            <p class="fw-medium">
              {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
            </p>
        </div>

        @if ($showingConfirmation)
          <div class="mt-2">
            <x-auth.label for="code" value="{{ __('Code') }}" />
            <x-auth.input id="code" class="d-block mt-3 w-100" type="text" inputmode="numeric" name="code" autofocus autocomplete="one-time-code"
                wire:model="code"
                wire:keydown.enter="confirmTwoFactorAuthentication" />
            <x-auth.input-error for="code" class="mt-3" />
          </div>
        @endif
      @endif

      @if ($showingRecoveryCodes)
        <p class="card-text mt-2">
          {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
        </p>

        <div class="bg-light rounded p-2">
          @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
            <div>{{ $code }}</div>
          @endforeach
        </div>
      @endif
    @endif

    <div class="mt-2">
      @if (!$this->enabled)
        <x-auth.confirms-password wire:then="enableTwoFactorAuthentication">
          <x-auth.button type="button" wire:loading.attr="disabled">
            {{ __('Enable') }}
          </x-auth.button>
        </x-auth.confirms-password>
      @else
        @if ($showingRecoveryCodes)
          <x-auth.confirms-password wire:then="regenerateRecoveryCodes">
            <x-auth.secondary-button class="me-1">
              {{ __('Regenerate Recovery Codes') }}
            </x-auth.secondary-button>
          </x-auth.confirms-password>
        @elseif ($showingConfirmation)
          <x-auth.confirms-password wire:then="confirmTwoFactorAuthentication">
            <x-auth.button type="button" wire:loading.attr="disabled">
              {{ __('Confirm') }}
            </x-auth.button>
          </x-auth.confirms-password>
        @else
          <x-auth.confirms-password wire:then="showRecoveryCodes">
            <x-auth.secondary-button class="me-1">
              {{ __('Show Recovery Codes') }}
            </x-auth.secondary-button>
          </x-auth.confirms-password>
        @endif
    
        <x-auth.confirms-password wire:then="disableTwoFactorAuthentication">
          <x-auth.danger-button wire:loading.attr="disabled">
            {{ __('Disable') }}
          </x-auth.danger-button>
        </x-auth.confirms-password>
      @endif
    </div>
    
  </x-slot>
</x-auth.action-section>
