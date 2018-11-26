{{ Form::open(['route' => 'links.originale']) }}
@csrf

{{Form::text('url')}}

{{ Form::submit('Click Me!') }}

{{ Form::close() }}