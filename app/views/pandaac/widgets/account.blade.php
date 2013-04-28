{{-- Login --}}
@if ( ! Auth::check() and ! Route::is('login'))
	<section class="case" id="widget-account-login">
		<h2><img src="{{ Theme::asset('img/cases/titles/account/login.png') }}" alt="Account"></h2>
		
		{{ Form::open(['url' => 'account/login']) }}
			{{ Form::token() }}

			<p>
				Please enter your credentials to access &amp; manage your account.
				If you no longer have access to your account, you may <a href="{{ URL::to('account/recover') }}">request</a> a new password.
			</p>

			<section class="columns">
				<section class="column">{{ Form::label('account', 'Account:') }}</section>
				<section class="column">{{ Form::password('account', '', ['class' => 'small']) }}</section>
			</section>

			<section class="columns">
				<section class="column">{{ Form::label('password', 'Password:') }}</section>
				<section class="column">{{ Form::password('password', '', ['class' => 'small']) }}</section>
			</section>

			<p>
				{{ Form::submit('Login', array('class' => 'button')) }}
				@if ( ! Route::is('get account/create'))
					or <a href="{{ URL::to('account/create') }}">register</a>
				@endif
			</p>
		{{ Form::close() }}
	</section>
@endif




{{-- Account Management --}}
@if (Auth::check() and ! Route::is('get account'))
	<section class="case" id="widget-account">
		<h2><img src="{{ Theme::asset('img/cases/titles/account/index.png') }}" alt="Account"></h2>
		
		<p> ... ... ... </p>
	</section>
@endif