    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">
                    {{ GetSetting::getConfig('site-name') }}
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    
                    <!-- #END# Call Search -->
                    <!-- Notifications -->

                    @if( Auth::user()->role == 0 )


                        @if( Auth::user()->credit_add > 0 )
                        
                            <li><a href="{{ route('links.add') }}" class=""><i class="material-icons">link</i> You can add {{ floor( Auth::user()->credit_add ) }} link now</a></li>

                        @endif


                        @if( Auth::user()->link_click == Auth::user()->number_clicked )
                        
                            <li><a href="javascript:void(0);" class=""><i class="material-icons">check</i> Equality in links</a></li>

                        @else

                            <li><a href="javascript:void(0);" class=""><i class="material-icons">refresh</i> Equality on loading</a></li>

                        @endif


                        <li><a href="javascript:void(0);" class=""><i class="material-icons">star</i> Points: {{ Auth::user()->points * GetSetting::getConfig('points-multiplication') }}</a></li>

                    @endif


                    
                    <!-- #END# Tasks -->
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                </ul>
            </div>
        </div>
    </nav>