<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>General Dashboard </title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('admin/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/modules/fontawesome/css/all.min.css')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin/modules/jqvmap/dist/jqvmap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/modules/weather-icon/css/weather-icons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/modules/weather-icon/css/weather-icons-wind.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/modules/summernote/summernote-bs4.css')}}">
 <link rel="stylesheet" href="{{ asset('admin/modules/select2/dist/css/select2.min.css')}}">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/css/components.css')}}">
 <link rel="stylesheet" href="{{ asset('admin/modules/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">
  <!-- In the <head> tag, add Toastr CSS -->
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      @include('backend.layout.navebar')
      <div class="main-sidebar sidebar-style-2">
        @include('backend.layout.asidbar')
      </div>

      <!-- Main Content -->
      <div class="main-content">
       @yield('content')
      </div>
      @include('backend.layout.footer')
    </div>
  </div>

@stack('scripts')
  <script src="{{ asset('admin/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/modules/popper.js')}}"></script>
  <script src="{{ asset('admin/modules/tooltip.js')}}"></script>
  <script src="{{ asset('admin/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('admin/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('admin/modules/moment.min.js')}}"></script>
  <script src="{{ asset('admin/js/stisla.js')}}"></script>
  <script src="{{ asset('admin/modules/simple-weather/jquery.simpleWeather.min.js') }}"></script>
  <script src="{{ asset('admin/modules/chart.min.js') }}"></script>
  <script src="{{ asset('admin/modules/jqvmap/dist/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('admin/modules/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
  <script src="{{ asset('admin/modules/summernote/summernote-bs4.js') }}"></script>
  <script src="{{ asset('admin/modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
<!-- jQuery first -->


<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('admin/js/page/index-0.js')}}"></script>
 <script src="{{ asset('admin/modules/select2/dist/js/select2.full.min.js')}}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('admin/js/scripts.js')}}"></script>
  <script src="{{ asset('admin/js/custom.js')}}"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
  <script src="{{ asset('admin/modules/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('admin/js/page/modules-datatables.js')}}"></script>


  <script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif

    $(document).ready(function() {
        // CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // sweet alert for delete
        $('body').on('click', '.delete-item', function(e){
            e.preventDefault();
            let deleteUrl = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST', // Use POST because DELETE via <a> is non-standard
                        url: deleteUrl,
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data){
                            if(data.status === 'error'){
                                Swal.fire(
                                    'Cannot delete!',
                                    data.message || 'Something went wrong.',
                                    'error'
                                );
                            } else {
                                Swal.fire(
                                    'Deleted!',
                                    data.message || 'Deleted successfully.',
                                    'success'
                                );
                                setTimeout(() => window.location.reload(), 1500);
                            }
                        },
                        error: function(xhr){
                            Swal.fire(
                                'Oops!',
                                'Server error occurred.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

</body>
</html>
