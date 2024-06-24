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
    const trixEditor = document.getElementById('{{ $id }}')
    const mimeTypes = ['image/png', 'image/jpeg', 'image/jpg']

    addEventListener('trix-blur', ev => {
        @this.set('{{ $model_name }}', trixEditor.getAttribute('value'))
    })

    addEventListener('trix-file-accept', ev => {
        if (!mimeTypes.includes(ev.file.type)) {
            // file type not allowed, prevent default upload
            return ev.preventDefault()
        }
    })

    addEventListener('trix-attachment-add', ev => {
        console.log('Gabisa bg')
    })
</script>
