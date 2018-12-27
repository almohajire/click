<aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info" style='background-image: url({{ GetSetting::ifImg('bg-profile-img') }})'>
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
                    <li class="{{ \App\Helpers\Common\Links::ifActive('users.home') }}">
                        <a href="{{ route('users.home') }}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    @if( Auth::user()->role > 0 || Auth::user()->credit_add > 0 )

                        <li class="{{ \App\Helpers\Common\Links::ifActive('links.add') }}">
                            <a href="{{ route('links.add') }}">
                                <i class="material-icons">link</i>
                                <span>Add Link</span>
                            </a>
                        </li>

                    @else

                    <li class="">
                        <a href="#" id="btn-add-link-cant">
                            <i class="material-icons">link</i>
                            <span>Add Link</span>
                        </a>
                    </li>



                    @endif

                    <li class="{{ \App\Helpers\Common\Links::ifActive('links.mine') }}">
                        <a href="{{ route('links.mine') }}">
                            <i class="material-icons">link</i>
                            <span>My Links</span>
                        </a>
                    </li>

                    @if( Auth::user()->role == 0 )
                    <li class="{{ \App\Helpers\Common\Links::ifActive('links.mining') }}">
                        <a href="{{ route('links.mining') }}">
                            <i class="material-icons">local_atm</i>
                            <span>Mining</span>
                        </a>
                    </li>

                        @if( Auth::user()->points >= GetSetting::getConfig('points-to-activate') )

                        <li class="{{ \App\Helpers\Common\Links::ifActive('links.points_mining') }}">
                            <a href="{{ route('links.points_mining') }}">
                                <i class="material-icons">star</i>
                                <span>Points Mining</span>
                            </a>
                        </li>

                        @endif

                    @endif

                    @if( Auth::user()->role > 0 )

                    <li class="header">Admin</li>

                    <li class="{{ \App\Helpers\Common\Links::ifActive('configs.index') }}">
                        <a href="{{ route('configs.index') }}">
                            <i class="material-icons">settings</i>
                            <span>Configurations</span>
                        </a>
                    </li>

                    <li class="{{ \App\Helpers\Common\Links::ifActive('links.unconfirmed') }}">
                        <a href="{{ route('links.unconfirmed') }}">
                            <i class="material-icons">link</i>
                            <span>Unconfirmed links</span>
                        </a>
                    </li>

                    <li class="{{ \App\Helpers\Common\Links::ifActive('reports.index') }}">
                        <a href="{{ route('reports.index') }}">
                            <i class="material-icons">unarchive</i>
                            <span>Reports</span>
                        </a>
                    </li>

                    @endif
                </ul>
            </div>
            <!-- #Menu -->
            <!-- Footer -->
            <!-- #Footer -->
</aside>

