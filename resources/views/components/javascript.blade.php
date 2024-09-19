<script data-navigate-once="true">
    function sideBarCollapse() {
        const sidebar = document.getElementById('sidebar')
        const toogleSideBar = document.getElementsByClassName('sidebar-toggle')[0]

        toogleSideBar.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed')
        })
    }
    function fixDropdown() {
        // Select the .table-responsive element
        const tableResponsive = document.querySelector('.table-responsive')

        if(tableResponsive === null) return

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
        sideBarCollapse()
        fixDropdown()

        document.body.setAttribute("data-scroll-x", window.scrollX)
    });

    document.addEventListener('livewire:initialized', () => {
        sideBarCollapse()
        fixDropdown()

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

        Livewire.on('setValueById', params => {
            setTimeout(() => {
                document.getElementById(params.id).value = params.value
            }, 500);
        })
    })
</script>
