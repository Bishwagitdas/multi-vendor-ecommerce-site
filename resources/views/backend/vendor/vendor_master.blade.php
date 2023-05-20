<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('backend/assets/images/favicon-32x32.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	<link href="{{asset('backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/fancy-file-uploader/fancy_fileupload.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/basic.css" integrity="sha512-+Vla3mZvC+lQdBu1SKhXLCbzoNCl0hQ8GtCK8+4gOJS/PN9TTn0AO6SxlpX8p+5Zoumf1vXFyMlhpQtVD5+eSw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	 <!-- FilePond styles -->
	 <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
	 <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('backend/assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{asset('backend/assets/js/pace.min.js')}}"></script>
	<!-- Databale CSS -->
	<link href="{{asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<!-- Bootstrap CSS -->
	<link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('backend/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('backend/assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('backend/assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{asset('backend/assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{asset('backend/assets/css/header-colors.css')}}" />
	<title>Vendor | Portal - Multi-Vendor eCommerce</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		    @include('backend.vendor.partials.sidebar')
		<!--end sidebar wrapper -->
        <!--start header -->
            @include('backend.vendor.partials.header')
        <!--end header -->
		<!--start page wrapper -->
            <div class="page-wrapper">
                @yield('contents')
            </div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
        <!--start footer -->
        @include('backend.vendor.partials.footer')
        <!--end footer -->
	</div>
	<!--end wrapper-->
	<!--start switcher-->

	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
    <script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/chartjs/js/Chart.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/jquery-knob/excanvas.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
	  <script>
		  $(function() {
			  $(".knob").knob();
		  });
	  </script>
      <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
	  <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

      	<!-- DataTales js -->
	<script src="{{asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>

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
	  <script src="{{asset('backend/assets/js/index.js')}}"></script>
	<!--app JS-->
	<script src="{{asset('backend/assets/js/app.js')}}"></script>
</body>

</html>
