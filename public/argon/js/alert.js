
(function($) {
    'use strict'

    $(function() {
        $('[data-toggle="sweet-alert"]').on('click', function(){
            var type = $(this).data('sweet-alert');
            var message = $(this).data('message');

            switch (type) {
                case 'basic':
                    swal({
                        text: message,
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-primary'
                    })
                break;

                case 'info':
                    swal({
                        text: message,
                        type: 'info',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-info'
                    })
                break;

                case 'info':
                    swal({
                        text: message,
                        type: 'info',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-info'
                    })
                break;

                case 'success':
                    swal({
                        text: message,
                        type: 'success',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-success'
                    })
                break;

                case 'warning':
                    swal({
                        text: message,
                        type: 'warning',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-warning'
                    })
                break;

                case 'question':
                    swal({
                        text: message,
                        type: 'question',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-default'
                    })
                break;

                case 'confirm':
                    swal({
                        text: message,
                        type: 'warning',
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-danger',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonClass: 'btn btn-secondary'
                    }).then((result) => {
                        if (result.value) {
                            swal({
                                title: 'Deleted!',
                                text: 'Your file has been deleted.',
                                type: 'success',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-primary'
                            });
                        }
                    })
                break;

                case 'image':
                    swal({
                        title: 'Sweet',
                        text: "Modal with a custom image ...",
                        imageUrl: '../../assets/img/ill/ill-1.svg',
                        buttonsStyling: false,
                        confirmButtonClass: 'btn btn-primary',
                        confirmButtonText: 'Super!'
                });
                break;

                case 'timer':
                    swal({
                        title: 'Auto close alert!',
                        text: 'I will close in 2 seconds.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                break;
            }
        });

    });
}(jQuery))
