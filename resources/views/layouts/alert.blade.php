<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    @if (session()->get('success'))
    toastr.success("{{ session()->get('success') }}");
    @endif
    @if (session()->get('error'))
    toastr.error("{{ session()->get('error') }}");
    @endif

    @if (session()->get('warning'))
    toastr.warning("{{session()->get('warning')}}");
    @endif
    @if (session()->get('info'))
    toastr.info("{{session()->get('info')}}");
    @endif
</script>

