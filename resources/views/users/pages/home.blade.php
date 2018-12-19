@extends('users.layouts.app')
@section('content')

<div class="container-fluid">
            <div class="block-header">
                <h2>Home</h2>
            </div>







			<div class="row clearfix">
                @if( Auth::user()->is_admin )

                    <a href="{{ route('links.unconfirmed')}}">

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box bg-pink hover-expand-effect">
                                <div class="icon">
                                    <i class="material-icons">playlist_add_check</i>
                                </div>
                                <div class="content">
                                    <div class="text">Need to be confirmed</div>
                                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{ App\Link::where('confirmed', false)->count() }}</div>
                                </div>
                            </div>
                        </div>

                    </a>

                @else

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-pink hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">playlist_add_check</i>
                            </div>
                            <div class="content">
                                <div class="text">Click Confirmed</div>
                                <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{ Auth::user()->links()->where('confirmed', true)->count() }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-cyan hover-expand-effect">
                            <div class="icon">
                                <i class="material-icons">link</i>
                            </div>
                            <div class="content">
                                <div class="text">Click Clicked</div>
                                <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{ Auth::user()->number_click }}</div>
                            </div>
                        </div>
                    </div>

                @endif

                
            </div>








<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Best 10 Users</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            @if(Auth::user()->role > 0)
                                                <th>Has links</th>
                                                <th>Discovered links</th>
                                                <th>Links succefully clicked on</th>
                                            @endif
                                            <th>Points</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	
                                    	@foreach($bestusers as $bu => $b_user)

                                    	<tr>
                                            <td>{{ $bu }}</td>
                                            <td>{{ $b_user->name }}</td>
                                            @if(Auth::user()->is_admin)
                                                <td><span class="label bg-orange">{{ $b_user->links->count() }}</span></td>
                                                <td><span class="label bg-blue">{{ $b_user->discoverdLinks->count() }}</span></td>
                                                <td><span class="label bg-blue">{{ $b_user->discoverdLinks->count() }}</span></td>
                                            @endif
                                            <td><span class="label bg-green">{{ $b_user->points * GetSetting::getConfig('points-multiplication') }}</span></td>
                                            
                                        </tr>

                                    	@endforeach
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>










        </div>
@endsection