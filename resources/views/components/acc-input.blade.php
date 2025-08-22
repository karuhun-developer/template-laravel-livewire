@props([
    'model',
    'type' => 'text',
    'label' => null,
    'live' => false,
    'debounce' => false,
    'debounceMs' => 500,
    'class' => 'form-control',
    'placeholder' => '',
    'rows' => 5,
    'livewire' => true,
    'old' => null,
    'icon' => null,
    'error' => true,
    'filled' => false,
])

<div class="input-group input-group-outline input-group-flat
    @if($filled) is-filled @endif
" wire:ignore.self>
    @if($icon)
        <span class="input-group-text">
            <i class="{{ $icon }}"></i>
        </span>
    @endif
    @if($label)
        <label class="form-label">
            {{ $label }}
        </label>
    @endif
    @if($type == 'select')
        <select
            @if($livewire)
                @if($live)
                    wire:model.live="{{ $model }}"
                @elseif($debounce)
                    wire:model.live.debounce.{{ $debounceMs }}="{{ $model }}"
                @else
                    wire:model="{{ $model }}"
                @endif
            @else
                name="{{ $model }}"
            @endif
            class="{{ $class }} @error($model) is-invalid @enderror" {!! $attributes !!}>

            {{ $slot }}

        </select>

    @elseif($type == 'textarea')
        <textarea
            @if($livewire)
                @if($live)
                    wire:model.live="{{ $model }}"
                @elseif($debounce)
                    wire:model.live.debounce.{{ $debounceMs }}="{{ $model }}"
                @else
                    wire:model="{{ $model }}"
                @endif
            @else
                name="{{ $model }}"
            @endif
            class="{{ $class }} @error($model) is-invalid @enderror"
            placeholder="{{ $placeholder }}"
            rows="{{ $rows }}" {!! $attributes !!}>{{ $old }}</textarea>

    @else
        <input
            @if($livewire)
                @if($live)
                    wire:model.live="{{ $model }}"
                @elseif($debounce)
                    wire:model.live.debounce.{{ $debounceMs }}="{{ $model }}"
                @else
                    wire:model="{{ $model }}"
                @endif
            @else
                name="{{ $model }}"
            @endif
            value="{{ $old }}"
            type="{{ $type }}"
            class="{{ $class }} @error($model) is-invalid @enderror"
            placeholder="{{ $placeholder }}" {!! $attributes !!} />

    @endif
</div>

@if($error)
    <x-acc-input-error for="{{ $model }}" />
@endif
