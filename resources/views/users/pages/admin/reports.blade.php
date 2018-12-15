@extends('users.layouts.app')

@section('content')



<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                REPORTS
                                <small>reports</small>
                            </h2>

                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>User</th>
                                        <th>Message</th>


                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($items as $item)

                                    <tr>
                                        <th scope="row"> {{ $item->created_at }} </th>
                                        <td>{{ $item->reporter->name }}</td>

                                        <td>{{ $item->message }}</td>

                                    </tr>

                                	@endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


@if(count( $items ))
    {!! $items->links() !!}
@endif

@endsection