@props(['title' => __('Confirm Password'), 'content' => __('For your security, please confirm your password to continue.'), 'button' => __('Confirm')])

@php
$confirmableId = md5($attributes->wire('then'));
@endphp

<span {{ $attributes->wire('then') }} x-data x-ref="span"
  x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
  x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);">
  {{ $slot }}
</span>

@once
  <x-auth.dialog-modal wire:model.live="confirmingPassword">
    <x-slot name="title">
      {{ $title }}
    </x-slot>

    <x-slot name="content">
      {{ $content }}

      <div class="mt-3" x-data="{}"
        x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
        <x-auth.input type="password" class="{{ $errors->has('confirmable_password') ? 'is-invalid' : '' }}"
          placeholder="{{ __('Password') }}" x-ref="confirmable_password" wire:model="confirmablePassword"
          wire:keydown.enter="confirmPassword" />

        <x-auth.input-error for="confirmable_password" />
      </div>
    </x-slot>

    <x-slot name="footer">
      <x-auth.secondary-button wire:click="stopConfirmingPassword" wire:loading.attr="disabled">
        {{ __('Cancel') }}
      </x-auth.secondary-button>

      <x-auth.button class="ms-1" dusk="confirm-password-button" wire:click="confirmPassword" wire:loading.attr="disabled">
        {{ $button }}
      </x-auth.button>
    </x-slot>
  </x-auth.dialog-modal>
@endonce
