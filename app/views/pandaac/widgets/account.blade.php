{{-- Login --}}
@if ( ! Auth::check() and ! Route::is('login'))
	<section class="case">
		<h2><img src="{{ Theme::asset('img/cases/titles/account/login.png') }}" alt="Account"></h2>
		
		{{ Form::open(['url' => 'account/login']) }}
			{{ Form::token() }}

			<p>
				Please enter your credentials to access &amp; manage your account.
				If you no longer have access to your account, you may <a href="{{ URL::to('account/recover') }}">request</a> a new password.
			</p>
			<table cellspacing="0" cellpadding="0" border="0" style="margin: 10px;">
				<tr>
					<td style="padding: 0 3px; width: 35%;">
						{{ Form::label('name', 'Account:') }}
					</td>
					<td>{{ Form::text('account', '', array('class' => 'small')) }}</td>
				</tr>
				<tr>
					<td style="padding: 0 3px; width: 35%;">
						{{ Form::label('password', 'Password:') }}
					</td>
					<td>{{ Form::text('password', '', array('class' => 'small')) }}</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-top: 10px;">
						{{ Form::submit('Login', array('class' => 'button')) }}
						@if ( ! Route::is('get account/create'))
							or <a href="{{ URL::to('account/create') }}">register</a>
						@endif
					</td>
				</tr>
			</table>
		{{ Form::close() }}
	</section>
@endif


{{-- Account Management --}}
@if (Auth::check() and ! Route::is('get account'))
	<section class="case">
		<h2><img src="{{ Theme::asset('img/cases/titles/account/index.png') }}" alt="Account"></h2>
		<p> ... ... ... </p>
	</section>
@endif