<script type="text/javascript">
        
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true,
    });

    @if (Session::has('success'))
        Toast.fire({
            iconColor: '#89B76C',
            icon: 'success',
            title: '{{ Session::get('success') }}',
            customClass: {
            title: 'success-title',
            timerProgressBar: 'timer-success',
            popup: 'border-toast'
            },
        })
    @endif

    @if (Session::has('error'))
        Toast.fire({
            iconColor: '#F38686',
            icon: 'error',
            title: '{{ Session::get('error') }}',
            customClass: {
            title: 'error-title',
            timerProgressBar: 'timer-error',
            popup: 'border-toast'
            },
        })
    @endif

    @if (Session::has('warning'))
        Toast.fire({
            icon: 'warning',
            title: '{{ Session::get('warning') }}'
        })
    @endif
 
</script>