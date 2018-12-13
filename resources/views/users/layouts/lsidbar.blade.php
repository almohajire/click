<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('users/images/user.png') }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            
                            <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="material-icons">input</i>Sign Out
                                </a>
                            </li>







                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active">
                        <a href="/home">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    @if( Auth::user()->role > 0 || Auth::user()->number_click >= 2 )

                    <li>
                        <a href="{{ route('links.add') }}">
                            <i class="material-icons">link</i>
                            <span>Add Link</span>
                        </a>
                    </li>

                    @else

                    <li>
                        <a href="#" id="btn-add-link-cant">
                            <i class="material-icons">link</i>
                            <span>Add Link</span>
                        </a>
                    </li>



                    @endif

                    <li>
                        <a href="{{ route('links.mine') }}">
                            <i class="material-icons">link</i>
                            <span>My Links</span>
                        </a>
                    </li>

                    @if( Auth::user()->role == 0 )
                    <li>
                        <a href="{{ route('links.mining') }}">
                            <i class="material-icons">local_atm</i>
                            <span>Mining</span>
                        </a>
                    </li>
                    @endif

                    @if( Auth::user()->role > 0 )

                    <li class="header">Admin</li>
                    <li>
                        <a href="{{ route('links.unconfirmed') }}">
                            <i class="material-icons">link</i>
                            <span>Unconfirmed links</span>
                        </a>
                    </li>

                    @endif
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <!-- #Footer -->
</aside>

