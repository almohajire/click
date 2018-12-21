<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ GetSetting::getConfig('site-name') }} |  @yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ asset('users/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('users/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <!-- Waves Effect Css -->
    <link href="{{ asset('users/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('users/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    @yield('#styles')

    <!-- Custom Css -->
    <link href="{{ asset('users/css/style.css') }}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{ asset('users/css/themes/all-themes.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" integrity="sha256-pMhcV6/TBDtqH9E9PWKgS+P32PVguLG8IipkPyqMtfY=" crossorigin="anonymous" />

    <style>
        section.content{
            margin-top: 70px;
            margin-left:0px;
            margin-right:0px;
        }

        .all-frame{
            width: 100%; position: absolute; height: 100%; border: none;
        }
    </style>


    @yield('styles')
</head>


@if(Auth::guest())
<body class="theme-red">
@else
<body class="theme-{{ \App\Helpers\Common\Holder::template_colors( Auth::user()->color )['slug'] }}">
@endif
<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    @include('users.layouts.topbar_surf')

    </section>

    <section class="content">
        @yield('content')
    </section>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>

    <!-- Jquery Core Js -->
    <script src="{{ asset('users/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{ asset('users/plugins/bootstrap/js/bootstrap.js') }}"></script>

    <!-- Select Plugin Js -->
    <script src="{{ asset('users/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="{{ asset('users/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{ asset('users/plugins/node-waves/waves.js') }}"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('users/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    @yield('#scripts')

    <!-- Sparkline Chart Plugin Js -->
    <script src="{{ asset('users/plugins/jquery-sparkline/jquery.sparkline.js') }}"></script>

    <!-- Custom Js -->
    <script src="{{ asset('users/js/admin.js') }}"></script>
    <!--<script src="{{ asset('users/js/pages/index.js') }}"></script>-->

    <!-- Demo Js -->
    <script src="{{ asset('users/js/demo.js') }}"></script>


    <!--<script src="{{ asset('js/sweet/sweetalert.min.js') }}"></script>-->

    @include('sweetalert::alert')


    <script src="{{ asset('js/axios/axios.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js" integrity="sha256-XWzSUJ+FIQ38dqC06/48sNRwU1Qh3/afjmJ080SneA8=" crossorigin="anonymous"></script>

    <script type="text/javascript">

        NProgress.start();
   
    </script>

    @yield('scripts')


</body>

</html>
