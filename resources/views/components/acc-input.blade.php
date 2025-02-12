@props([
    'model',
    'type' => 'text',
    'live' => false,
    'debounce' => false,
    'debounceMs' => 500,
    'class' => 'form-control',
    'placeholder' => 'Input',
    'rows' => 5,
    'livewire' => false,
    'old' => null,
    'icon' => null,
    'error' => true,
])

@if($type == 'select')
    <select
        @if($livewire)
            @if($live)
                wire:model.live="{{ $model }}"
            @elseif($debounce)
                wire:model.debounce.{{ $debounceMs }}="{{ $model }}"
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
                wire:model.debounce.{{ $debounceMs }}="{{ $model }}"
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
    <div class="input-group">
        @if($icon)
            <span class="input-group-text">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <input
        @if($livewire)
            @if($live)
                wire:model.live="{{ $model }}"
            @elseif($debounce)
                wire:model.debounce.{{ $debounceMs }}="{{ $model }}"
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
    </div>

@endif

@if($error)
    <x-acc-input-error for="{{ $model }}" />
@endif
