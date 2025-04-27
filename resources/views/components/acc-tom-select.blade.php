@props([
    'onUpdateFunction' => 'setEditData',
    'fetchFunction',
    'ref' => 'selectRepo',
    'valueField' => 'id',
    'labelField' => 'name',
    'searchField' => 'name',
    'model',
    'customOptions',
    'placeholder' => 'Select item...',
    'setTomValue' => 'set-tom-select',
])
<div wire:ignore>
    @php
        $randId = Str::random(10);
    @endphp
    <select placeholder="{{ $placeholder }}"
        id="{{ $ref }}"
        x-ref="{{ $ref }}"
        x-data="{
            setTomValue(params) {
                const element = document.getElementById(params.ref)
                element.tomselect.clear(true)
                element.tomselect.clearOptions()
                element.tomselect.addOption(params.data)
                element.tomselect.addItem(params.value)
                element.tomselect.setValue(params.value)
            },
            clearTomValue(params) {
                let element = document.getElementById(params.ref)
                element.tomselect.clear(true)
                element.tomselect.clearOptions()
                element.tomselect.setValue(null)
            },
            init() {
                new TomSelect(this.$refs.{{ $ref }}, {
                    valueField: '{{ $valueField }}',
                    labelField: '{{ $labelField }}',
                    searchField: '{{ $searchField }}',
                    load(query, callback) {
                        $wire.{{ $fetchFunction }}(query)
                        .then(menus => callback(menus))
                        .catch(() => callback())
                    },
                    render: {
                        {!! $customOptions ?? '' !!}
                    },
                })
            }
        }"
        wire:model.live="{{ $model }}"
        x-on:set-tom-value.window="setTomValue($event.detail)"
        x-on:clear-tom-value.window="clearTomValue($event.detail)"
        {{ $attributes->merge(['class' => 'form-control']) }}
        {{ $attributes ?? '' }}>
    </select>
</div>
@once
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.min.css">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
@endonce
