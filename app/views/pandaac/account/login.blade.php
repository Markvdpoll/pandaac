@section('content')

	<p>
		@lang('pandaac/account.login.description', ['passhint' => Lang::choice('pandaac/account.login.passhint', (pandaac::password('secure') != 'secure'))])
	</p>

	@if ($errors)
		<ul class="errors">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif

	<section class="columns l55-r45" id="form-login">
		<section class="column">
			{{ Form::open(['url' => 'account/login']) }}
				{{ Form::token() }}

				<p>
					{{ Form::label('account', Lang::get('pandaac/account.name').':') }}
					{{ Form::password('account') }}
				</p>

				<p>
					{{ Form::label('password', Lang::get('pandaac/account.password').':') }}
					{{ Form::password('password') }}
				</p>

				<p class="inline">
					{{ Form::label('remember', Lang::get('pandaac/account.registration.remember')) }}
					{{ Form::checkbox('remember', 'on', Input::old('remember', false), ['id' => 'remember']) }}
				</p>

				<p>
					{{ Form::submit(Lang::get('pandaac/account.login.submit'), array('class' => 'button')) }}
				</p>

			{{ Form::close() }}
		</section>

		<section class="column">
			<h3>@lang('pandaac/account.links.title')</h3>
			<ul>
				<li><a href="{{ URL::to('account/recover') }}" tabindex="1000">@lang('pandaac/account.links.recover')</a></li>
				<li><a href="{{ URL::to('account/create') }}" tabindex="1001">@lang('pandaac/account.links.signup')</a></li>
			</ul>
		</section>
	</section>

@stop

