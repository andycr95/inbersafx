
    <script src="{{ asset('asset/theme3/frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/theme3/frontend/vendor/purecounter/purecounter.js') }}"></script>
    <script src="{{ asset('asset/theme3/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('asset/theme3/frontend/js/feather.min.js') }}"></script>

    <script src="{{ asset('asset/theme3/frontend/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('asset/theme3/frontend/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('asset/theme3/frontend/js/selectric.min.js') }}"></script>

    <script src="{{ asset('asset/theme3/frontend/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('asset/theme3/frontend/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('asset/theme3/frontend/js/user_dashboard.js') }}"></script>


    <!-- ========= Custom JS Files Start =========  -->
    <!-- Bootstrap -->
    <script src="{{asset('asset/theme3/assets/js/lib/bootstrap.bundle.min.js')}}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- Splide -->
    <script src="{{asset('asset/theme3/assets/js/plugins/splide/splide.min.js')}}"></script>
    <!-- Base Js File -->
    <script src="{{asset('asset/theme3/assets/js/base.js')}}"></script>
    <!-- Sweet Alert 2.0 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Owl carousel 2.3.4 -->
    <script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                navigation : true, // Show next and prev buttons
                slideSpeed : 300,
                paginationSpeed : 400,
                loop:true,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                items : 1,
                itemsDesktop : false,
                itemsDesktopSmall : false,
                itemsTablet: false,
                itemsMobile : false
            });
        });
        'use strict';
        $(document).ready(function() {
            $(document).on('click', '#calculate-btn', function() {

                let modal = $('#calculationModal');

                $('.selectplan').text('');
                $('.amount').text('');
                let id = $('#plan').val();
                let amount = $('#amount').val();
                var url = "{{ route('user.investmentcalculate', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        amount: amount,
                        selectplan: id
                    },
                    success: (data) => {
                        if (data.message) {
                            iziToast.error({
                                message: data.message + ' ' + Number(data.amount)
                                    .toFixed(2),
                                position: 'topRight',
                            });

                        } else {
                            $('#profit').html(data);
                            modal.modal('show');
                        }


                    },
                    error: (error) => {
                        if (typeof(error.responseJSON.errors.amount) !== "undefined") {
                            iziToast.error({
                                message: error.responseJSON.errors.amount,
                                position: 'topRight',
                            });
                        }
                        if (typeof(error.responseJSON.errors.selectplan) !== "undefined") {
                            iziToast.error({
                                message: error.responseJSON.errors.selectplan,
                                position: 'topRight',
                            });
                        }
                    }
                })
            });
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Add to Home with 2 seconds delay.
        AddtoHome("2000", "once");

        const customPush = (route) => {
            window.history.pushState("", "", route);
        }

        //-- float-button --//
        $('.action-button').on('click', function(){
            $(this).toggleClass('active');
            $('.float-btn').toggleClass('d-none');
        })

        //-- Notify --//
        const notifyMsg = (msg,cls) => {
            Swal.fire({
                position: 'center',
                // position: 'top-end',
                icon: cls,
                title: msg,
                toast:true,
                showConfirmButton: false,
                timer: 2100
            })
        }

        // redirect
        const GoTo = (route) => {
            window.location.href = route;
        }

        const BtnSPIN = `<div class="spinner-border spinner-border-sm" role="status"></div>`;


    </script>
    <!-- ========= Custom JS Files End =========  -->

    @stack('script')

    @if (@$general->twak_allow)
        <script type="text/javascript">
            'use strict'
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = "https://embed.tawk.to/{{ @$general->twak_key }}";
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
    @endif

    @if (Session::has('error'))
        <script>
            notifyMsg("{{ session('error') }}", 'error');
        </script>
    @endif

    @if (Session::has('success'))
        <script>
            notifyMsg("{{ session('success') }}", 'success');
        </script>
    @endif
    @if (session()->has('notify'))
        @foreach (session('notify') as $msg)
            <script>
                notifyMsg("{{ trans($msg[1]) }}", '{{ $msg[0] }}');
            </script>
        @endforeach
    @endif

    @if (@$errors->any())
        <script>
            "use strict";
            @foreach ($errors->all() as $error)
                notifyMsg("{{ __($error) }}", 'error');
            @endforeach
        </script>
    @endif

    <script>
        'use strict'
        var url = "{{ route('user.changeLang') }}";

        $(".changeLang").change(function() {
            if ($(this).val() == '') {
                return false;
            }
            window.location.href = url + "?lang=" + $(this).val();
        });

        feather.replace();

        // responsive menu slideing
        $(".d-sidebar-menu>li>a").on("click", function() {
            var element = $(this).parent("li");
            if (element.hasClass("open")) {
                element.removeClass("open");
                element.find("li").removeClass("open");
                element.find("ul").slideUp(500, "linear");
            } else {
                element.addClass("open");
                element.children("ul").slideDown();
                element.siblings("li").children("ul").slideUp();
                element.siblings("li").removeClass("open");
                element.siblings("li").find("li").removeClass("open");
                element.siblings("li").find("ul").slideUp();
            }
        });

        $('.sidebar-open-btn').on('click', function() {
            $(this).toggleClass('active');
            $('.d-sidebar').toggleClass('active');
        });
    </script>

    <!-- Pull The Scripts -->
    <div class="pullScript"></div>
