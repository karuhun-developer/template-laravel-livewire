<script data-navigate-once="true">
    function fixDropdown() {
        // Select the .table-responsive element
        const tableResponsive = document.querySelector('.table-responsive')

        if(!tableResponsive) return

        // When the dropdown is shown, change the overflow to 'inherit'
        tableResponsive.addEventListener('show.bs.dropdown', function () {
            tableResponsive.style.overflow = 'inherit'
        })

        // When the dropdown is hidden, change the overflow back to 'auto'
        tableResponsive.addEventListener('hide.bs.dropdown', function () {
            tableResponsive.style.overflow = 'auto'
        })
    }

    document.addEventListener("livewire:navigated", function() {
        fixDropdown()
        document.body.setAttribute("data-scroll-x", window.scrollX)
    });

    document.addEventListener('livewire:initialized', () => {
        fixDropdown()
        Livewire.on('alert', params => {
            window.Toast.fire({
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

            window.Swal.fire(swalParams).then((result) => {
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
