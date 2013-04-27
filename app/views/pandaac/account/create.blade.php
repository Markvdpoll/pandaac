@section('content')

	<p>@lang('pandaac/account.registration.description')</p>

	@if ($errors)
		<ul class="errors">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	@endif

	<section class="columns l55-r45" id="form-registration">
		<section class="column">
			{{ Form::open(['url' => 'account/create']) }}
				{{ Form::token() }}

				<p>
					{{ Form::label('account', Lang::get('pandaac/account.name').':') }}
					{{ Form::text('account', Input::old('account')) }}
				</p>

				<p>
					{{ Form::label('password', Lang::get('pandaac/account.password').':') }}
					{{ Form::password('password') }}
				</p>

				<p>
					{{ Form::label('repeat', Lang::get('pandaac/account.repeatpass').':') }}
					{{ Form::password('repeat') }}
				</p>

				<p>
					{{ Form::label('email', Lang::get('pandaac/account.email').':') }}
					{{ Form::text('email', Input::old('email')) }}
				</p>

				@if (GD\Processor::isGDEnabled())
					<p id="captcha-img">
						<label for="captcha"><img src="{{ URL::to('captcha') }}" alt="Captcha"></label>
						{{ Form::text('captcha', null, ['id' => 'captcha']) }}

						@if (Session::get('captcha-refreshes') >= 5)
							<a href="{{ URL::to('captcha/refresh') }}" title="{{ Lang::get('pandaac/account.registration.captchaExceeded') }}" id="refresh-captcha"></a>
						@else
							<a href="{{ URL::to('captcha/refresh') }}" title="{{ Lang::get('pandaac/account.registration.captcha') }}" id="refresh-captcha"></a>
						@endif
					</p>
				@endif

				<p class="pushed" id="terms-box">
					{{ Form::checkbox('terms', 'on', Input::old('terms', false), ['id' => 'terms']) }} 
					{{ Form::label('terms', Lang::get('pandaac/account.registration.terms.comply')) }}
					<a href="{{ URL::to('account/terms') }}">@lang('pandaac/account.registration.terms.terms')</a>
				</p>

				<p class="pushed">
					{{ Form::submit(Lang::get('pandaac/account.registration.submit'), array('class' => 'button')) }}
				</p>

			{{ Form::close() }}
		</section>

		<section class="column">
			<h3>@lang('pandaac/account.links.title')</h3>
			<ul>
				<li><a href="{{ URL::to('account/recover') }}" tabindex="1000">@lang('pandaac/account.links.recover')</a></li>
				<li><a href="{{ URL::to('account/login') }}" tabindex="1001">@lang('pandaac/account.links.login')</a></li>
			</ul>
		</section>
	</section>

@stop