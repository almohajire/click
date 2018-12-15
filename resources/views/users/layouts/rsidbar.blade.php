<aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
                <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                    <ul class="demo-choose-skin">

                        @foreach(\App\Helpers\Common\Holder::template_colors() as $nc =>$color)

                            
                            <li data-theme="{{ $color['slug'] }}" class="btn-theme-color {{$nc == Auth::user()->color ? 'active': ''}}" data-id="{{$nc}}" id="color-{{$nc}}">
                                <div class="{{ $color['slug'] }}"></div>
                                <span>{{ $color['name'] }}</span>
                            </li>

                        @endforeach


                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="settings">
                    <div class="demo-settings">
                        <p>LINK SETTINGS</p>
                        
                        <ul class="setting-list">
                            <li>
                                <span>OPEN MY SHORTEN PROVIDER LINK  WHEN COPY?</span>
                                <div class="switch">
                                    <label><input id="shorten_open" type="checkbox" {{ Auth::user()->shorten_open ? 'checked' : '' }}><span class="lever"></span></label>
                                </div>
                            </li>
                            
                        </ul>
                        <!--
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>

                        -->
                    </div>
                </div>
            </div>
        </aside>