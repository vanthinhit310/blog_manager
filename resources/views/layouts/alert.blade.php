@if (session()->get('success'))
    <script>
        toastr.success("{{ session()->get('success') }}");
    </script>
@endif
@if (session()->get('error'))
    <script>
        toastr.error("{{ session()->get('error') }}");
    </script>
@endif

@if (session()->get('warning'))
    <script>
        toastr.warning("{{session()->get('warning')}}");
    </script>
@endif
@if (session()->get('info'))
    <script>
        toastr.info("{{session()->get('info')}}");
    </script>
@endif

