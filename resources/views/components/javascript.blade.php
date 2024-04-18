<script data-navigate-once="true">
    function sideBarCollapse() {
        const sidebar = document.getElementById('sidebar')
        const toogleSideBar = document.getElementsByClassName('sidebar-toggle')[0]

        toogleSideBar.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed')
        })
    }
    document.addEventListener("livewire:navigated", function() {
        sideBarCollapse()

        feather.replace()
    });

    document.addEventListener('livewire:initialized', () => {
        sideBarCollapse()

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

        Livewire.hook('morph.updated', ({ el, component }) => {
            feather.replace()
        })

        Livewire.on('alert', params => {
            Toast.fire({
                icon: params.type ?? 'success',
                title: params.message
            })
        })

        Livewire.on('confirm', params => {
            Swal.fire({
                title: params.title ?? 'Are you sure?',
                text: params.message ?? `You won't be able to revert this`,
                icon: params.icon ?? 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch(params.function, {id: params.id})
                }
            })
        })

        Livewire.on('closeModal', params => {
            const modal = document.getElementById(params.modal)
            const modalBackdrop = document.getElementsByClassName('modal-backdrop')[0]

            modal?.classList?.remove('show')
            modalBackdrop?.remove()
        })

        Livewire.on('setValueById', params => {
            setTimeout(() => {
                document.getElementById(params.id).value = params.value
            }, 500);
        })
    })
</script>
