@props([
    'model',
    'type' => 'text',
    'live' => false,
    'debounce' => false,
    'debounceMs' => 500,
    'class' => 'form-control',
    'placeholder' => 'Input',
    'rows' => 5,
    'livewire' => true,
    'old' => null,
    'icon' => null,
    'error' => true,
])

<div class="input-group input-group-flat">
    @if($icon)
        <span class="input-group-text">
            <i class="{{ $icon }}"></i>
        </span>
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
