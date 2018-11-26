@extends('users.layouts.app')


@section('content')




<div class="container-fluid">
            <div class="block-header">
                <h2>Add codegen</h2>
            </div>




<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Short This Link <small></small>

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
                        <div class="body">
                            <h2 class="card-inside-title">Add link</h2>

                            <form id="form">

	                            <div class="row clearfix">
	                                <div class="col-sm-12">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="codegen" class="form-control" placeholder="codegen" id="codegen">
	                                        </div>
	                                    </div>

	                                </div>
	                            </div>


	                            <div class="row clearfix">
	                                <div class="col-sm-12">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="submit"  class="form-control" id="submit">
	                                        </div>
	                                    </div>

	                                </div>
	                            </div>	
                            </form>



                        </div>
                    </div>
                </div>
            </div>














        </div>







@endsection


@section('scripts')

<script src="{{ asset('js/axios/axios.min.js') }}"></script>

	<script src="{{ asset('js/validate/validate.min.js') }}"></script>

	<script type="text/javascript">

		console.log( 
			history);

		var $form = $('#form');
		var $submit = $('#submit');





		$submit.on('click',function(e){
			e.preventDefault();
			if( $form.valid() ){

				axios.post('/link/check/{{ Auth::id() }}/{{ $link->id }}',{
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        codegen: $('#codegen').val()
                        
                        }).then(function(success){

                        	var data = success.data;
                        	var link = data.link;
                        	var message = data.message;

							swal(
								'Good',
								'++++++',
								'success'

							);

                        })
						.catch(function(error){
							console.log(error);

					swal('No',
						error,
						'error'

					);


						});

			}else{
				swal(
						'No',
						'You should back to your form',
						'error'

					);
			}
		})


		
	</script>



@endsection