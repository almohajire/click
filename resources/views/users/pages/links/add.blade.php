@extends('users.layouts.app')

@section('styles')
<style type="text/css">
	.form-border-none{
		border:none !important;
	
	}
</style>

@endsection
@section('content')

<div class="container-fluid">
            <div class="block-header">
                <h2>Add link</h2>
            </div>




<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                

                                
                                
                            </h2>

                        </div>
                        <div class="body">
                            <h2 class="card-inside-title">Add link by shorten this</h2>

							

                            <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="{{$link}}" />
                                        </div>
                                    </div>

                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="form-line text-center form-border-none">
                                            <button class="btn btn-block btn-info copy"  data-clipboard-text="{{ $link }}">
									    		Copy to clipboard to shrink link
											</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <hr />

                            <form id="form">

	                            <div class="row clearfix">
	                                <div class="col-sm-12">
	                                    <div class="form-group">
	                                        <div class="form-line">
	                                            <input type="text" name="link" class="form-control" placeholder="url.com" id="link">
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


	<script src="{{ asset('js/validate/validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/clipboard/clipboard.min.js') }}"></script>
	<script type="text/javascript">

		var $form = $('#form');
		var $submit = $('#submit');

		var $linksent = $('#link-sent');

		var clipboard = new ClipboardJS('.copy');



		clipboard.on('success', function(e) {

			@if( Auth::user()->shorten_open )

				window.open('{{ Auth::user()->shorten_url}}' , '_blank');

			@endif
		    
			

			//past = document.execCommand("paste");



		});



		$submit.on('click',function(e){
			e.preventDefault();
			if( $form.valid() && ($linksent.text() != $('#link').val() ) ){


				axios.post('/link/store',{
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        link: $('#link').val(),
                        hash: '{{ $hash }}' 
                        }).then(function(success){

                        	var data = success.data;
                        	var link = data.link;
                        	var message = data.message;

							swal(
								'Good',
								'Link added',
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