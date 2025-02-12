<script data-navigate-once="true">
    document.addEventListener("livewire:navigated", function() {
        document.body.setAttribute("data-scroll-x", window.scrollX)
    });

    document.addEventListener('livewire:initialized', () => {
        // Toast initialization
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Livewire.on('alert', params => {
            Toast.fire({
                icon: params.type ?? 'success',
                title: params.message
            })
        })

        Livewire.on('confirm', params => {
            let swalParams = {
                title: params.title ?? 'Are you sure?',
                text: params.message ?? `You won't be able to revert this`,
                icon: params.icon ?? 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: params.confirmText ?? 'Yes',
                cancelButtonText: params.cancelText ?? 'Cancel'
            }

            // If params withDenyButton
            if(params?.withDenyButton) {
                swalParams.showDenyButton = true
                swalParams.denyButtonColor = params?.denyColor ?? '#ffc107'
                swalParams.denyButtonText = params?.denyText ?? 'Deny'
            }

            Swal.fire(swalParams).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(params.function, {id: params.id})
                }

                // If params withDenyButton
                if(result?.isDenied) {
                    Livewire.dispatch(params?.denyFunction, {id: params?.denyId})
                }
            })
        })

        Livewire.on('setValueById', params => {
            setTimeout(() => {
                document.getElementById(params.id).value = params.value
            }, 500);
        })
    })
</script>
