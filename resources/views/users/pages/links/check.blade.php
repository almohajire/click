@extends('users.layouts.app')

@section('styles')
<style type="text/css">
	.form-border-none{
		border:none !important;
	
	}
</style>

@endsection

@section('content')

<div class="alert alert-info redirect">
	<h2>Wait You will be redirected to mining soon!</h2>
</div>


		<div class="container-fluid">
            <div class="block-header">
                <h2>Add codegen</h2>
            </div>




			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Add codegen <small></small>

                            </h2>

                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Add codegen</h2>

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



			@if( Auth::user()->is_admin && $link->user->role == 0 )


	            <div class="row clearfix">
	                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                    <div class="card">
	                        <div class="header">
	                            <h2>
	                                Admin Area <small></small>

	                            </h2>

	                        </div>
	                        <div class="body">
	                            <h2 class="card-inside-title">Admin Area</h2>



		                            <div class="row clearfix">
		                                <div class="col-sm-12 col-md-6">
		                                    <div class="form-group">
		                                        <div class="form-line form-border-none">

		                                        	@foreach( App\Helpers\Common\Holder::linkLevel() as $l => $level )

		                                            <button class="btn btn-{{ $level['class'] }} btn-block btn-confirm-or-delete" data-id="{{ $link->id }}" data-confdel="confirm" data-level="{{ $l }}">Confirm as level {{ $l+1 }}</button>

		                                            @endforeach

		                                        </div>
		                                    </div>

		                                </div>

		                                <div class="col-sm-12 col-md-6">
		                                    <div class="form-group">
		                                        <div class="form-line form-border-none">
		                                            <button class="btn btn-danger btn-block btn-confirm-or-delete" data-id="{{ $link->id }}" data-confdel="delete">Delete</button>
		                                        </div>
		                                    </div>

		                                </div>
		                            </div>






	                        </div>
	                    </div>
	                </div>
	            </div>


            @endif














        </div>







@endsection


@section('scripts')



	<script src="{{ asset('js/validate/validate.min.js') }}"></script>

	<script type="text/javascript">

		console.log( 
			history);

		var $form = $('#form');
		var $submit = $('#submit');
		var $redirect = $('.redirect');


		@if( Auth::user()->is_admin )





			var $confirmOrDelete = $('.btn-confirm-or-delete');


			$confirmOrDelete.on('click',function(e){
				e.preventDefault();

				$this = $(this);

				$this.attr('disabled',true);

				id = $(this).data('id');

		        axios.post('/admin/link/'+ $(this).data('confdel') +'/'+ id ,{
		            headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		            },
		            level:$(this).data('level')
		        }).then(function(success){

		            $redirect.show();



		            swal(
		                'Good',
		                'Success',
		                'success'
		            );

		            window.location = "{{ route('links.unconfirmed') }}";

		        })
		        .catch(function(error){
		            console.log(error);

		            swal('No',
		                'error',
		                'error'
		                );

		            $this.attr('disabled',false);
		            
		        });



			});


		@endif

		$redirect.hide();





		$submit.on('click',function(e){
			e.preventDefault();
			if( $form.valid() ){

				

				@if($way == 'user2user' || $way == 'user2admin')

					var url = '/link/check/{{ Auth::id() }}/{{ $link->id }}';

				@else

					var url = '/link/exchange-check/{{ Auth::id() }}/{{ $link->id }}';

				@endif

				axios.post(url,{
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        codegen: $('#codegen').val()
                        
                        }).then(function(success){

                            $redirect.show();

                        	var data = success.data;
                        	var link = data.link;
                        	var message = data.message;

							swal(
								'Good',
								'++++++',
								'success'

							);

							@if($way == 'admin2admin')

								window.location = "{{ route('links.exchange') }}";

							@elseif($way == 'admin2user')

								window.location = "{{ route('links.unconfirmed') }}";

							@else

								window.location = "{{ route('links.mining') }}";

							@endif




							

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