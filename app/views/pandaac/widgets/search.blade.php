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