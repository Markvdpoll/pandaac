@section('content')

	<p>Welcome back, {{ $user->email }}!</p>

	<h3>Characters</h3>
	<ul>
		@foreach ($user->players()->get() as $player)
			<li>{{ $player->name }}</li>
		@endforeach
	</ul>

@stop