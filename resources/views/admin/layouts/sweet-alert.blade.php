<script type="text/javascript">
    
    var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
    });

    @if (Session::has('success'))
        Toast.fire({
            icon: 'success',
            title: '{{ Session::get('success') }}'
        })
    @endif

    @if (Session::has('error'))
        Toast.fire({
            icon: 'error',
            title: '{{ Session::get('error') }}'
        })
    @endif

    @if (Session::has('warning'))
        Toast.fire({
            icon: 'warning',
            title: '{{ Session::get('warning') }}'
        })
    @endif
    
</script>