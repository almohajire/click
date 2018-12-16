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
                                        <th>Actions</th>


                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($items as $item)

                                    <tr id="{{ $item->id }}">
                                        <th scope="row"> {{ $item->created_at }} </th>
                                        <td>{{ $item->reporter->name }}</td>

                                        <td>{{ $item->message }}</td>
                                        <td><button class="btn btn-warning btn-delete"  data-id="{{ $item->id }}">Delete</button></td>

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


@section('scripts')

    
<script>
    $delete = $('.btn-delete');

    $delete.on('click', function(e){
        e.preventDefault();

        id = $(this).data('id');

        axios.post('report/delete/'+ id ,{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(function(success){

            var $tr = $('#'+id);

            $tr.remove();

            swal(
                'Good',
                'Report deleted',
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
</script>

@endsection