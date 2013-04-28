<section class="case" id="widget-status">
	<h2><img src="{{ Theme::asset('img/cases/titles/server-status.png') }}" alt="Server Status"></h2>

	<p>
		The server is currently 
		@if (Server::status())
			<span class="online">online</span>.<br>
		
			There are <span class="highlight">{{ Server::players() }}</span> out of 
			<span class="highlight">{{ Server::maxPlayers() }}</span> players online.
		@else
			<span class="offline">offline</span>.
		@endif
	</p>

	<p class="indent">
		<strong>IP:</strong> <span class="highlight">{{ Server::ip() }}</span><br>
		<strong>Port:</strong> <span class="highlight">{{ Server::port() }}</span><br>
		<strong>Client:</strong> <span class="highlight">{{ Server::protocol() }}</span>
	</p>

	@if (Server::status())
		<p>
			Why don't you have a look whether your friends or foes are <a href="">online</a>!
		</p>
	@endif
</section>