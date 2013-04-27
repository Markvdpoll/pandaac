<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<link href="{{ Theme::asset('img/favicon.png') }}" rel="icon" type="image/png">

	<!-- Stylesheets -->
	<link href="{{ Theme::asset('css/reset.css') }}" rel="stylesheet" media="all">
	<link href="{{ Theme::asset('css/default.css') }}" rel="stylesheet" media="all">
	<link href="{{ Theme::asset('css/jquery-ui/lightness.css') }}" rel="stylesheet" media="all">
	<link href="{{ Theme::asset('css/redactor/dark.css') }}" rel="stylesheet" media="all">
	<link href="{{ Theme::asset('css/codemirror/codemirror.css') }}" rel="stylesheet" media="all">
	<link href="{{ Theme::asset('css/codemirror/blackboard.css') }}" rel="stylesheet" media="all">

	<title>{{ Theme::title() }}</title>
</head>
<body>

	<section id="skeleton">
		<!-- Header -->
		<header>
			<section id="logo">
				<a href="{{ URL::to('/') }}"><img src="{{ Theme::asset('img/logo.png') }}" alt="Logo"></a>
			</section>
		</header>

		<section id="wrapper">
			<!-- Navigation -->
			<section id="navigation">
				<nav>
					@section("navigation")
					<ul>
						<li><a href="{{ URL::to('/') }}"><figure class="nav-button-home"></figure></a></li>
						<li><a href="{{ URL::to('account') }}"><figure class="nav-button-account"></figure></a></li>
						@if (Auth::check())
							<li><a href="{{ URL::to('account/logout') }}"><figure class="nav-button-logout"></figure></a></li>
						@else
							<li><a href="{{ URL::to('account/create') }}"><figure class="nav-button-create"></figure></a></li>
						@endif
						<li><a href="{{ URL::to('highscores') }}"><figure class="nav-button-highscores"></figure></a></li>
						<li><a href="{{ URL::to('guilds') }}"><figure class="nav-button-guilds"></figure></a></li>
						<li><a href="{{ URL::to('houses') }}"><figure class="nav-button-houses"></figure></a></li>
						<li><a href="{{ URL::to('forum') }}"><figure class="nav-button-forum"></figure></a></li>
						<li><a href="{{ URL::to('downloads') }}"><figure class="nav-button-downloads"></figure></a></li>
						<li><a href="{{ URL::to('donate') }}"><figure class="nav-button-donate"></figure></a></li>
						<li><a href="{{ URL::to('server') }}"><figure class="nav-button-info"></figure></a></li>
					</ul>
					@yield_section
				</nav>
			</section>

			<!-- Content -->
			<section id="content">
				<!-- Left Sidepanel -->
				<section class="panel" id="left">
					@yield("submenu")

					<section class="case">
						<h2><img src="{{ Theme::asset('img/cases/titles/quicksearch.png') }}" alt="Quick Search"></h2>

						{{ Form::open(['class' => 'search-guild-character']) }}
							<p>
								{{ Form::label('search', 'Name:') }}
								{{ Form::text('search', '', array('class' => 'ui-autocomplete')) }}
							</p>
							<p>
								{{ Form::submit('Search', array('class' => 'button')) }}
							</p>
						{{ Form::close() }}
					</section>

					@if ( ! Route::is('highscores'))
						<section class="case">
							<h2><img src="{{ Theme::asset('img/cases/titles/quickscores.png') }}" alt="Quick Scores"></h2>
							<p>
								Displaying the 10 top players.
							</p>
							<ol>
								<li><a href="">Chris</a> &ndash; 245 MS</li>
								<li><a href="">Account Manager</a> &ndash; 239 RP</li>
								<li><a href="">Random Bloke</a> &ndash; 237 RP</li>
								<li><a href="">Shawn O'reily</a> &ndash; 221 ED</li>
								<li><a href="">Griffin</a> &ndash; 221 EK</li>
								<li><a href="">The Executor</a> &ndash; 219 EK</li>
								<li><a href="">Shameus</a> &ndash; 217 MS</li>
								<li><a href="">Sour Cowmilk</a> &ndash; 205 ED</li>
								<li><a href="">Lupe Fiasco</a> &ndash; 198 RP</li>
								<li><a href="">Guy Sebastian</a> &ndash; 197 RP</li>
							</ol>
							<p>
								Check out all the <a href="">highscore</a> lists!
							</p>
						</section>
					@endif
				</section>

				<!-- Main Content -->
				<section class="panel">
					<section class="case">
						<h1>
							<ul class="case-title">
								{{ Theme::breadcrumbs($__env->yieldContent('title')) }}
							</ul>
						</h1>

						<section id="route-{{ Theme::routeAsClass() }}">
							@yield('content')
						</section>
					</section>
				</section>

				<!-- Right Sidepanel -->
				<section class="panel" id="right">

					@if (! Auth::check() and ! Route::is('login'))
						<section class="case">
							<h2><img src="{{ Theme::asset('img/cases/titles/account/index.png') }}" alt="Account"></h2>
							
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

					<section class="case">
						<h2><img src="{{ Theme::asset('img/cases/titles/server-status.png') }}" alt="Server Status"></h2>

						<p>
							The server is currently 
							@if (Server::status())
								<span class="online">online</span>.<br>
							
								There are <span style="color: #e6e6e6;">{{ Server::players() }}</span> out of <span style="color: #e6e6e6;">{{ Server::maxPlayers() }}</span> players online.
							@else
								<span class="offline">offline</span>.
							@endif
						</p>
						<p style="margin-left: 20px; line-height: 140%;">
							<strong>IP:</strong> <span style="color: #e6e6e6;">{{ Server::ip() }}</span><br>
							<strong>Port:</strong> <span style="color: #e6e6e6;">{{ Server::port() }}</span><br>
							<strong>Client:</strong> <span style="color: #e6e6e6;">{{ Server::protocol() }}</span>
						</p>
						@if (Server::status())
							<p>
								Why don't you have a look whether your friends or foes are <a href="">online</a>!
							</p>
						@endif
					</section>
				</section>
			</section>
		</section>

		<!-- Footer -->
		<footer>
			<div style="color: #666;">
				Copyright &copy; {{ Server::name() }} 
				{{ (date('Y') == 2013 ? date('Y') : 2013 . ' - ' . date('Y')) }}.
				All rights reserved.
			</div>
			<div style="font-size: 90%;">
				Powered by <a href="http://www.pandaac.net/" target="_blank" style="color: inherit;">pandaac</a>,
				a <a href="https://www.bluepanda.se/" target="_blank" style="color: inherit;">Blue Panda</a> product.
			</div>
		</footer>
	</section>


	<!-- JavaScripts -->
	<script>var SITEURL = '{{ URL::to("/") }}';</script>
	<script src="{{ Theme::asset('js/jquery-1.7.2.min.js') }}"></script>
	<script src="{{ Theme::asset('js/jquery-ui-1.8.23.min.js') }}"></script>
	<script src="{{ Theme::asset('js/modernizr-2.5.3.min.js') }}"></script>
	<script src="{{ Theme::asset('js/jquery.colorbox-min.js') }}"></script>
	<script src="{{ Theme::asset('js/redactor.min.js') }}"></script>
	<script src="{{ Theme::asset('js/custom.js') }}"></script>
	<script src="{{ Theme::asset('js/codemirror.js') }}"></script>
	<script src="{{ Theme::asset('js/codemirror-javascript.js') }}"></script>
	<script src="{{ Theme::asset('js/codemirror-xml.js') }}"></script>
	<script src="{{ Theme::asset('js/codemirror-css.js') }}"></script>

</body>
</html>