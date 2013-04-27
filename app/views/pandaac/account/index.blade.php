@section('content')

	<p>Welcome back, {{ $user->email }}!</p>

	<h3>Characters</h3>
	<ul>
		@foreach ($user->characters()->get() as $character)
			<li>{{ $character->name }}</li>
		@endforeach
	</ul>

@stop