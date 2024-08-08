@props([
    'id' => 'id_trix_description',
    'model' => '',
    'model_name' => 'trix_description',
])

<input id="{{ $id }}" type="hidden" name="{{ $model_name }}" value="{{ $model }}">
<trix-editor wire:ignore input="{{ $id }}" class="trix-content"></trix-editor>

<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
<script>
    addEventListener('trix-blur', ev => {
        @this.set('{{ $model_name }}', document.getElementById('{{ $id }}').getAttribute('value'))
    })

    addEventListener('trix-file-accept', ev => {
        if (!['image/png', 'image/jpeg', 'image/jpg'].includes(ev.file.type)) {
            // file type not allowed, prevent default upload
            return ev.preventDefault()
        }
    })

    addEventListener('trix-attachment-add', ev => {
        console.log('Gabisa bg')
    })
</script>
