<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/x-icon" href="{{asset(!empty($site_info->favicon) ? $site_info->favicon : 'sticker1.png')}}">
    <title>Admin{{ !empty($site_info->site_title) ? ' - '.$site_info->site_title : null }}</title>
    <meta name="_token" content="{{ csrf_token() }}" /> 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('backend/plugins/fontawesome/css/all.min.css')}}">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{url('backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    
    <!-- Sweetalert2 CSS -->
    <link rel="stylesheet" href="{{url('backend/plugins/sweetalert2/sweetalert2.min.css')}}">

    <!-- Select2 CSS -->
    {{-- <link rel="stylesheet" href="{{url('backend/plugins/select2/css/select2.css')}}"> --}}

    <!-- Ekko-lightbox CSS -->
    <link rel="stylesheet" href="{{url('backend/plugins/ekko-lightbox/ekko-lightbox.css')}}">
    
    <!-- Datatables Css -->
    @include('admin.layouts.datatables_css')

    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    @livewireStyles

    <!-- My CSS -->
    <link rel="stylesheet" href="{{ url('backend/css/mystyle.css') }}">
    
    <script src="{{ asset('backend/plugins/ckeditor/ckeditor.js') }}"></script>
    
    <script type="text/javascript">
        function homeUrl() {
            return "{!! url('/') !!}";
        }
    </script>
  
    @yield('third_party_stylesheets')

    @yield('page_css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ !empty($site_info->logo) ? $site_info->logo : asset('backend/images/logo_admin.png')}}" alt="logo" width="100">
    </div>
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex" data-toggle="dropdown">
                    <img src="{{ Auth::user()->image ? Auth::user()->image : asset('backend/images/default.png') }} " class="user-image img-circle elevation-2" alt="User Image">
                    <div class="" style="display: flex;flex-direction: column;margin-top: -12px;">
                    <span class="" style="font-weight: 700">{{ Auth::user()->name }}</span>
                    <span class="">{{Auth::user()->getRoleNames()->first()}}</span>
                    </div>
                    <p style=" margin-left: 12px; "><i class="fas fa-caret-down" style="color: #a9abad;"></i></p>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-lightblue">
                        <img src="{{ Auth::user()->image ? Auth::user()->image : asset('backend/images/default.png') }}"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Thành viên từ {{ Auth::user()->created_at->format('d/m/Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        {{-- <a href="#" class="btn btn-default btn-flat">Profile</a> --}}
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('admin.layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer text-center">
        {{-- <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div> --}}
        <strong>Copyright &copy; {{date('Y')}} <a href="https://jks.vn/" target="_blank" style="color:#F69922">JKS.VN</a>.</strong> All rights
        reserved.
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"
        integrity="sha512-igl8WEUuas9k5dtnhKqyyld6TzzRjvMqLC79jkgT3z02FvJyHAuUtyemm/P/jYSne1xwFI06ezQxEwweaiV7VA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- MomentJs -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>


<!-- Tempusdominus Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"
        integrity="sha512-k6/Bkb8Fxf/c1Tkyl39yJwcOZ1P4cRrJu77p83zJjN2Z55prbFHxPs9vN7q3l3+tSMGPDdoH51AEU8Vgo1cgAA==" crossorigin="anonymous"></script>
{{-- <script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}

<!-- Ekko-lightbox CSS -->
<script src="{{url('backend/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>

<!-- Sweetalert2 JS  -->
<script src="{{url('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Select2  -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- Datatables Js -->
@include('admin.layouts.datatables_js')

<!-- CKEditor - CKFinder -->
<script src="{{ asset('backend/plugins/ckeditor5/build/ckeditor.js') }}"></script>
<script src="{{ asset('backend/plugins/ckfinder/ckfinder.js') }}"></script>

<!-- TinyMce -->
<script src="{{ asset('backend/plugins/tinymce/tinymce.min.js') }}"></script>

<script>
    // ClassicEditor.create( document.querySelector( '.editor' ), {
    //     toolbar: {
    //         shouldNotGroupWhenFull: true
    //     },
    //     ckfinder: {
    //         uploadUrl: homeUrl() +'/backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
    //     },
    // } )
    // .then( editor => {
    //     window.editor = editor;
    //     // const wordCountPlugin = editor.plugins.get( 'WordCount' );
    //     // const wordCountWrapper = document.getElementById( 'word-count' );

    //     // wordCountWrapper.appendChild( wordCountPlugin.wordCountContainer );
    // } )
    // .catch( error => {
    //     console.error( 'Oops, something went wrong!' );
    //     console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
    //     console.warn( 'Build id: jdk518jc9775-w2pct6o9iqdb' );
    //     console.error( error );
    // } );
</script>

<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<!-- My Script -->
<script src="{{ url('backend/js/myscript.js') }}"></script>
<script src="{{ url('backend/js/jquery.nestable.js') }}"></script>

<!-- Sweet Alert Config-->
@include('admin.layouts.sweet-alert')

@include('admin.layouts.modal-confim-delete')

@yield('third_party_scripts')

@yield('page_scripts')

</body>
</html>
