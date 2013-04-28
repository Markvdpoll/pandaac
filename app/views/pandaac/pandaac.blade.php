<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<link href="{{ Theme::asset('img/favicon.png') }}" rel="icon" type="image/png">

	{{-- Stylesheets --}}
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
		{{-- Header --}}
		<header>
			<section id="logo">
				<a href="{{ URL::to('/') }}"><img src="{{ Theme::asset('img/logo.png') }}" alt="Logo"></a>
			</section>
		</header>

		<section id="wrapper">
			{{-- Navigation --}}
			<section id="navigation">
				<nav>
					@section("navigation")
						<ul>
							<li><a href="{{ URL::to('/') }}"><figure id="nav-button-home"></figure></a></li>
							<li><a href="{{ URL::to('account') }}"><figure id="nav-button-account"></figure></a></li>
							@if (Auth::check())
								<li><a href="{{ URL::to('account/logout') }}"><figure id="nav-button-logout"></figure></a></li>
							@else
								<li><a href="{{ URL::to('account/create') }}"><figure id="nav-button-create"></figure></a></li>
							@endif
							<li><a href="{{ URL::to('highscores') }}"><figure id="nav-button-highscores"></figure></a></li>
							<li><a href="{{ URL::to('guilds') }}"><figure id="nav-button-guilds"></figure></a></li>
							<li><a href="{{ URL::to('houses') }}"><figure id="nav-button-houses"></figure></a></li>
							<li><a href="{{ URL::to('forum') }}"><figure id="nav-button-forum"></figure></a></li>
							<li><a href="{{ URL::to('downloads') }}"><figure id="nav-button-downloads"></figure></a></li>
							<li><a href="{{ URL::to('donate') }}"><figure id="nav-button-donate"></figure></a></li>
							<li><a href="{{ URL::to('server') }}"><figure id="nav-button-info"></figure></a></li>
						</ul>
					@show
				</nav>
			</section>

			{{-- Content --}}
			<section id="content">
				{{-- Left Sidepanel --}}
				<section class="panel" id="left">
					@yield("submenu")

					@include('widgets.search')
					@include('widgets.highscores')
				</section>

				{{-- Main Content --}}
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

				{{-- Right Sidepanel --}}
				<section class="panel" id="right">
					@include('widgets.account')
					@include('widgets.status')
				</section>
			</section>
		</section>

		{{-- Footer --}}
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


	{{-- JavaScripts --}}
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