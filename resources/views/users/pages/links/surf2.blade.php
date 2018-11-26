@extends('users.layouts.app')


@section('content')
	<p id="message"></p>
	<button class="btn btn-info copy"  data-clipboard-text="{{ $codegen }}">
	    Copy and skip
	</button>
	<a class="btn btn-info" target="_blank" href="{{ $link->link }}">
	    Visit add
	</a>
	<iframe title="" src="{{$displayLink}}" width="100%" height="500px">
  <p>Your browser does not support iframes.</p>
</iframe>
@endsection

@section('scripts')

<script type="text/javascript" src="{{ asset('js/clipboard/clipboard.min.js') }}"></script>

	<script type="text/javascript">

		$('.copy').hide();
		new ClipboardJS('.copy');



		function showCopy(delay = 4000){

		 
		 setTimeout(function(){
		  $('.copy').show();
		 },delay);
		 
		}

		  $('.copy').on('click', function(){

			document.getElementById("message").innerHTML = "Please wait, you are redirecting to the new page.";

			window.location = '{{ $link->link }}';

			});



		showCopy(4000);







	</script>
@endsection