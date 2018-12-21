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
                    <li>
                        <a class="" target="_blank" href="{{ $displayLink->link }}">
                            <i class="material-icons">visibility</i> Visit add
                        </a>
                        
                    </li>
                    <li >
                        <a href="#" class="copy" data-clipboard-text="{{ $codegen }}">
                            <i class="material-icons">content_copy</i> Copy and skip
                        </a>
                            
                        
                        
                    </li>
                    
    



                </ul>
            </div>
        </div>
    </nav>