@props([
    'id' => 'id_trix_description',
    'model' => '',
    'model_name' => 'trix_description',
    'file_model_name' => 'trix_photos',
])

<div wire:ignore>
    <input id="{{ $id }}" type="hidden" name="{{ $model_name }}" value="{{ $model }}">
    <trix-editor input="{{ $id }}" class="trix-content"></trix-editor>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
</div>

<script>
    const trixEditor = document.getElementById('{{ $id }}')
    const mimeTypes = ['image/png', 'image/jpeg', 'image/jpg']
    const onHoldAttachments = []

    addEventListener('trix-blur', ev => {
        @this.set('{{ $model_name }}', trixEditor.getAttribute('value'))
    })

    addEventListener('trix-file-accept', ev => {
        if (!mimeTypes.includes(ev.file.type)) {
            console.log('File type not allowed')
            // file type not allowed, prevent default upload
            return ev.preventDefault()
        }
    })

    addEventListener('trix-attachment-add', ev => {
        uploadTrixImage(ev.attachment)
    })

    addEventListener('trix-attachment-remove', ev => {
        @this.removeUpload('{{ $file_model_name }}', ev.attachment.attachment.previewURL)
    })

    function uploadTrixImage(attachment) {
        onHoldAttachments.push(attachment.file)

        // Upload
        @this.upload(
            '{{ $file_model_name }}',
            attachment.file,
            function(uploadedURL) {
                // We need to create a custom event.
                // This event will create a pause in thread execution until we get the Response URL from the Trix Component completeUpload
                const trixUploadCompletedEvent = `trix-upload-completed:${btoa(uploadedURL)}`
                const trixUploadCompletedListener = function(event) {
                    attachment.setAttributes(event.detail[0])
                    window.removeEventListener(trixUploadCompletedEvent, trixUploadCompletedListener)
                }

                window.addEventListener(trixUploadCompletedEvent, trixUploadCompletedListener)

                // call the Trix Component @completeUpload below
                @this.call('completeUpload', uploadedURL, trixUploadCompletedEvent)
            },
            function() {
                // Error callback
            },
            function(event) {
                // Progress callback
                attachment.setUploadProgress(event.detail.progress)
            },
            // complete the upload and get the actual file URL
        )
    }
</script>
