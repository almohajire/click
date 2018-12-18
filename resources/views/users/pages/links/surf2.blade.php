@extends('users.layouts.app')


@section('content')
	<p id="message"></p>
	<button class="btn btn-info copy"  data-clipboard-text="{{ $codegen }}">
	    Copy and skip
	</button>
	<a class="btn btn-info" target="_blank" href="{{ $displayLink->link }}">
	    Visit add
	</a>
	<iframe title="" src="{{ $displayLink->link }}" width="100%" height="500px">
  <p>Your browser does not support iframes.</p>
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
		  $('.copy').show();
		 },delay);
		 
		}


		clipboard.on('success', function(e) {

			document.getElementById("message").innerHTML = "Please wait, you are redirecting to the new page.";


			@if( GetSetting::getConfig('value-referrer')  != '' )

				$("head").append('<meta name="referrer" content="{{ GetSetting::getConfig('value-referrer') }}"/>');

				
			@endif


			document.getElementById('autoclick').click();
		    
			

			//past = document.execCommand("paste");



		});





		showCopy( Number( {{ GetSetting::getConfig('time-skip-ad-second') }}) * 1000 );


	</script>
@endsection