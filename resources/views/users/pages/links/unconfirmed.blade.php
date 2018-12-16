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

                        </div>
                        <div class="body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Confirmed</th>
                                        <th>Link</th>


                                        <th>Confirm</th>

                                    </tr>
                                </thead>
                                <tbody>
                                	@foreach($links as $link)

                                    <tr id="{{ $link->id }}">
                                        <th scope="row"><i class="material-icons">{{ $link->confirmed?'check_circle': 'highlight_off' }}</i></th>
                                        <td><a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a></td>
                                        <td class="confirm" data-id="{{ $link->id }}">
                                            <a class="btn-confirm" data-id="{{ $link->id }}" href="#">Confirm</a>
                                        </td>
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


@section('scripts')

    
<script>
    $conf = $('.btn-confirm');

    $conf.on('click', function(e){
        e.preventDefault();

        id = $(this).data('id');

        axios.post('confirm/'+ id ,{
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(function(success){

            var $tr = $('#'+id);

            $tr.remove();

            swal(
                'Good',
                'Link Confirmed and deleted',
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