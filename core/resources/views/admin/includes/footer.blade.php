<div class="flex justify-center items-center text-gray-700 text-sm 2xl:text-2xl font-semibold pt-8 2xl:pt-20">
    &copy; 2022 CredCrypto | All Rights Reserved
</div>


<script>
    $(document).ready(function() {
        $('#datatable-skeleton-table').DataTable({
            scrollX: true,
            "sScrollXInner": "100%",
        });

        $('#datatable-skeleton-table-2').DataTable({
            scrollX: true,
            "sScrollXInner": "100%",
        });

    });


    $('.resend-otp').on('click', function(e) {
        e.preventDefault();
        var clicked = $(this);
        $('#preloader').show();
        $.ajax({
            url: "{{ route('resend-otp') }}",
            type: "POST",
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                $('#preloader').hide();
                var timeleft = 60;
                var timer = setInterval(function() {
                    if (timeleft <= 0) {
                        clearInterval(timer);
                        clicked.html('Resend Otp');

                    } else {
                        clicked.html('<span class="text-red-500">Resend Otp in: ' +
                            timeleft + '</span>');
                    }
                    timeleft -= 1;
                }, 1000);

                clicked.css({
                    'pointer-events': 'none',
                });
                setTimeout(function() {
                    clicked.css({
                        'pointer-events': 'auto'
                    });
                    clicked.html('Resend Otp');
                }, 60000);

                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    text: 'OTP has been resent',
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,
                    
                });

            },
            error: function(response) {
                $('#preloader').hide();
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    text: 'Failed to resend otp',
                    showConfirmButton: false,
                    timer: 4500,
                    background: "#0e1726",
                    color: "#b9bead",
                    toast: true,
                    
                });

            },
        });
    });
</script>

<script type="text/javascript" src="{{ asset('public/assets/scripts/main.js') }}"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
    src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fh-3.2.4/kt-2.7.0/r-2.3.0/sc-2.0.7/sb-1.3.4/sp-2.0.2/datatables.min.js">
</script>



<script>
    $(".skiptranslate").text("")
</script>

{{--  page specific script --}}
@yield('script')



{{--  custom javascript --}}

{!! json_decode(websiteInfo('custom_js')) !!}

{{--  custom javascript end --}}


{{--  Sweet alert here --}}
@if (session()->has('fail'))
    <script>
        $(window).on('load', function() {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                text: "{{ session()->get('fail') }}",
                showConfirmButton: false,
                timer: 4500,
                background: "#0e1726",
                color: "#b9bead",
                toast: true,
                
            })
        })
    </script>
@elseif (session()->has('success'))
    <script>
        $(window).on('load', function() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                text: "{{ session()->get('success') }}",
                showConfirmButton: false,
                timer: 4500,
                background: "#0e1726",
                color: "#b9bead",
                toast: true,
                
            })
        })
    </script>
@endif

</body>

</html>
