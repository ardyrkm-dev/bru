<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{asset('assets/logo.svg')}}">
    <title>{{ $title }} | FitSolusi</title>

 
    @include('includes.Dashboard.style')


  </head>
  <body>

	<div class="page-content">

		<div class="sidebar sidebar-light sidebar-main sidebar-expand-lg">

			@include('includes.Dashboard.navbarKiri')
		</div>
		
		<div class="content-wrapper bgC  scrol">

		  
            @yield('content')

		</div>
		

	</div>


       
    @stack('prepend-script')
    @include('includes.Dashboard.script')
    @stack('addon-script')

    <script src="/assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/script.js"></script>
    <script src="/assets/js/dashboard.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Your custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarControl = document.querySelectorAll('.sidebar-control');
            const sidebar = document.querySelector('.sidebar-content');

            sidebarControl.forEach(control => {
                control.addEventListener('click', function() {
                    sidebar.classList.toggle('sidebar-collapsed');
                });
            });
        });
    </script>

   
    @if (session()->has('success'))
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: "{{ session('success') }}",
        });
      </script>
    @endif
    @if (session()->has('failed'))
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: "{{ session('failed') }}",
        });
      </script>
    @endif
    @if (isset($errors) && $errors->has('oldPassword') || $errors->has('password'))
      <script>
        const myModal = document.getElementById('modalUbahPassword');
        const modal = bootstrap.Modal.getOrCreateInstance(myModal);
        modal.show();
      </script>
    @endif
  </body>
</html>
