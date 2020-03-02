@if (session()->get('success') || session()->get('status') || session()->get('error') || session()->get('warning') || session()->get('info'))
    <script>
            @if (session()->get('success'))
        var alert_message = "{{ session()->get('success') }}",type='success';
            @endif
            @if (session()->get('error'))
        var alert_message = "{{ session()->get('error') }}",type='error';
            @endif

            @if (session()->get('warning'))
        var alert_message = "{{session()->get('warning')}}",type='warning';
            @endif
            @if (session()->get('info'))
        var alert_message = "{{session()->get('info')}}",type='info';
            @endif
            @if (session()->get('status'))
        var alert_message = "{{ session('status') }}",type='success';
        @endif
        $.notify({
            // options
            icon: 'ni ni-bell-55',
            title: 'Notify',
            message: alert_message
        }, {
            // settings
            element: 'body',
            position: null,
            type: type,
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "top",
                align: "center"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 5000,
            timer: 1000,
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
            template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<div><span data-notify="message">{2}</span></div>' +
                '<div class="progress" data-notify="progressbar">' +
                '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>'
        });
    </script>
@endif
