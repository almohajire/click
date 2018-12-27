@extends('users.layouts.app')

@section('content')



<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                BASIC TABLES
                                <small>Basic example without any additional modification classes</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Another action</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Confirmed</th>
                                        <th>Level</th>
                                        <th>Link</th>
                                        <th>Statistique</th>


                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($links as $link)

                                    <tr>
                                        <th scope="row"><i class="material-icons">{{ $link->confirmed?'check_circle': 'highlight_off' }}</i></th>
                                        @if( $link->confirmed )
                                            <td>{{ App\Helpers\Common\Holder::linkLevel( $link->level ) }}</td>
                                        @else
                                            <td>Not confirmed yet</td>
                                        @endif
                                        <td><a href="{{ $link->link}}" target="_blank">{{ $link->link}}</a></td>

                                        <td>{{ $link->clicked }}</td>

                                    </tr>

                                	@endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



{!! $links->links() !!}

@endsection