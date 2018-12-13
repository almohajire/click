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
    @include('users.layouts.topbar')
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
    @include('users.layouts.lsidbar')    
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
    @include('users.layouts.rsidbar')     
        <!-- #END# Right Sidebar -->
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

    <script type="text/javascript">
        
        if( $('#btn-add-link-cant').length ){

            $('#btn-add-link-cant').on('click',function(e){
                e.preventDefault();


                Swal({
                  type: 'error',
                  title: 'You can not add link now',
                  text: 'You should click on some links',
                  footer: '<a class="btn btn-primary btn-lg" href="{{ route('links.mining')}}">Go mine first</a>'
                });



            });
            
        }

        if( $('.btn-theme-color').length ){

            $('.btn-theme-color').on('click',function(e){

                id = $(this).data('id') ; 
                e.preventDefault();

                axios.post('/rightbar/theme-color/'+ id,{
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        
                        }).then(function(success){

                            swal(
                                'Good',
                                '++++++',
                                'success'

                            );

                        })
                        .catch(function(error){
                            console.log(error);

                            swal('No',
                                'error',
                                'error'

                            );


                        });



            });
            
        }
    </script>

    @yield('scripts')


</body>

</html>
