@props([
    'model',
    'type' => 'text',
    'live' => false,
    'debounce' => false,
    'debounceMs' => 500,
    'class' => 'form-control',
    'placeholder' => 'Input',
    'rows' => 5,
])

@if($type == 'select')
    <select
        @if($live)
            wire:model.live="{{ $model }}"
        @elseif($debounce)
            wire:model.debounce.{{ $debounceMs }}="{{ $model }}"
        @else
            wire:model="{{ $model }}"
        @endif
        class="{{ $class }} @error($model) is-invalid @enderror" {!! $attributes !!}>

        {{ $slot }}

    </select>

@elseif($type == 'textarea')
    <textarea
        @if($live)
            wire:model.live="{{ $model }}"
        @elseif($debounce)
            wire:model.debounce.{{ $debounceMs }}="{{ $model }}"
        @else
            wire:model="{{ $model }}"
        @endif
        class="{{ $class }} @error($model) is-invalid @enderror"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}" {!! $attributes !!}></textarea>

@else
    <input
        @if($live)
            wire:model.live="{{ $model }}"
        @elseif($debounce)
            wire:model.debounce.{{ $debounceMs }}="{{ $model }}"
        @else
            wire:model="{{ $model }}"
        @endif
        type="{{ $type }}"
        class="{{ $class }} @error($model) is-invalid @enderror"
        placeholder="{{ $placeholder }}" {!! $attributes !!} />

@endif

<x-acc-input-error for="{{ $model }}" />
