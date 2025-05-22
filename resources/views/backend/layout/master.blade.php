<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Blank Page &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
      <link rel="stylesheet" href="{{ asset('backend1/assets/modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('backend1/assets/modules/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend1/assets/modules/datatables/datatables.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('backend1/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('backend1/assets/css/components.css')}}">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      @include('backend.layout.navebar')
      <div class="main-sidebar">
        @include('backend.layout.asidbar')
      </div>

      <!-- Main Content -->
      <div class="main-content">

          @yield('content')
      </div>
      @include('backend.layout.footer')
      @stack('scripts')
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('backend1/assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
    <script src="{{ asset('backend1/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('backend1/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('backend1/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('backend1/assets/js/scripts.js') }}"></script>
 <script src="{{ asset('backend1/assets/modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('backend1/assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script src="{{ asset('backend1/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend1/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend1/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
  <!-- Page Specific JS File -->
</body>
</html>
