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