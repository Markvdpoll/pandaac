<section class="case" id="widget-search">
	<h2><img src="{{ Theme::asset('img/cases/titles/quicksearch.png') }}" alt="Quick Search"></h2>

	{{ Form::open(['url' => 'search']) }}
		{{ Form::token() }}

		<section class="columns">
			<section class="column">{{ Form::label('search', 'Name:') }}</section>
			<section class="column">{{ Form::text('search', '', ['class' => 'ui-autocomplete']) }}</section>
		</section>

		<p>
			{{ Form::submit('Search', ['class' => 'button']) }}
		</p>
	{{ Form::close() }}
</section>