@props([
    'id' => 'id_trix_description',
    'model' => '',
    'model_name' => 'trix_description',
    'file_model_name' => 'trix_photos',
    'function' => 'completeUpload',
])

<div wire:ignore>
    <input id="{{ $id }}" type="hidden" name="{{ $model_name }}" value="{{ $model }}">
    <trix-editor wire:ignore input="{{ $id }}" class="trix-content"
        x-data="{
            onHoldAttachments: [],
            uploadTrixImage(attachment) {
                this.onHoldAttachments.push(attachment.file)

                // Upload
                @this.upload(
                    '{{ $file_model_name }}',
                    attachment.file,
                    function(uploadedURL) {
                        // We need to create a custom event.
                        // This event will create a pause in thread execution until we get the Response URL from the Trix Component completeUpload
                        const trixUploadCompletedEvent = `trix-upload-completed:${btoa(uploadedURL)}`
                        const trixUploadCompletedListener = function(event) {
                            attachment.setAttributes(event.detail)
                            window.removeEventListener(trixUploadCompletedEvent, trixUploadCompletedListener)
                        }

                        window.addEventListener(trixUploadCompletedEvent, trixUploadCompletedListener)

                        // call the Trix Component @completeUpload below
                        const call = '{{ $function }}'
                        @this.call(call, uploadedURL, trixUploadCompletedEvent)
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
        }"
        x-on:trix-blur="
            @this.set('{{ $model_name }}', document.getElementById('{{ $id }}').getAttribute('value'))
        "
        x-on:trix-file-accept="if (!['image/png', 'image/jpeg', 'image/jpg'].includes($event.file.type)) {
            // file type not allowed, prevent default upload
            return $event.preventDefault()
        }"
        x-on:trix-attachment-add="uploadTrixImage($event.attachment)"
        {{-- x-on:trix-attachment-remove="@this.removeUpload('{{ $file_model_name }}', $event.attachment.attachment.previewURL)" --}}
    ></trix-editor>

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
</div>
