<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Nest - Multipurpose eCommerce HTML Template</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/imgs/theme/favicon.svg')}}')}}" />
    <!-- FilePond styles -->
	<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/animate.min.css')}}" />
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css?v=5.3')}}" />
</head>

<body>
    <!-- Modal -->
 
    <!-- Quick view -->

    @include('frontend.partials.quick_view')

    <!-- Header  -->

        @include('frontend.partials.header')

    <!-- End Header  -->

    <!--End header-->



    <main class="main">
        
       @yield('main_contents') 

    </main>


   
    <!-- Footer Start -->
        @include('frontend.partials.footer')
    <!-- Footer End -->

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{asset('frontend/assets/imgs/theme/loading.gif')}}" alt="" />
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/slick.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/counterup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/isotope.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{asset('frontend/assets/js/plugins/jquery.elevatezoom.js')}}"></script>
    <!-- Filepond js -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
  
    <!-- Sweetalert2 js -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    @if (Session::has('message'))
        {
  
            <script>
                Window.Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000,
                    timerProgressBar: false,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
  
  
                var type = "{{ Session::get('alert-type','success') }}"
  
                switch(type){
                    case 'success': Window.Toast.fire({
                                    icon: 'success',
                                    title: '{!! Session::get('message') !!}'
                                });
                                break;
                    case 'error': Window.Toast.fire({
                                    icon: 'error',
                                    title: '{!! Session::get('message') !!}'
                                });
                                break;
                    case 'warning': Window.Toast.fire({
                                    icon: 'warning',
                                    title: '{!! Session::get('message') !!}'
                                });
                                break;
                    case 'info': Window.Toast.fire({
                                    icon: 'info',
                                    title: '{!! Session::get('message') !!}'
                                });
                                break;
                }
  
               
  
            </script>
        }
    @endif
      
    @stack('scripts')

    <!-- Template  JS -->
    <script src="{{asset('frontend/assets/js/main.js')}}?v=5.3"></script>
    <script src="{{asset('frontend/assets/js/shop.js')}}?v=5.3"></script>
</body>

</html>