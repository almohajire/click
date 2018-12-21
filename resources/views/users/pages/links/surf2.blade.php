@extends('users.layouts.surf')


@section('content')

	<iframe title="" src="{{ $displayLink->link }}" class="all-frame">
  <div class="alert alert-warning">
  	<h2>Your browser does not support iframes.</h2>
  </div>
	</iframe>


<a href="{{ $link->link }}" rel="noreferrer" id="autoclick">Link</a>

@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('js/clipboard/clipboard.min.js') }}"></script>

	<script type="text/javascript">

		$('.copy').hide();
		$('#autoclick').hide();
		var clipboard = new ClipboardJS('.copy');


		function showCopy(delay = 4000){

		 
		 setTimeout(function(){
		 NProgress.done();
		  $('.copy').show();
		 },delay);
		 
		}


		clipboard.on('success', function(e) {
			swal('Copied', 'Please wait, you are redirecting to the new page.','success');


			@if( GetSetting::getConfig('value-referrer')  != '' )

				$("head").append('<meta name="referrer" content="{{ GetSetting::getConfig('value-referrer') }}"/>');

				
			@endif


			document.getElementById('autoclick').click();
		    
			

			//past = document.execCommand("paste");



		});





		showCopy( Number( {{ GetSetting::getConfig('time-skip-ad-second') }}) * 1000 );


	</script>
@endsection