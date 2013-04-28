<section class="case">
	<h2><img src="{{ Theme::asset('img/cases/titles/server-status.png') }}" alt="Server Status"></h2>

	<p>
		The server is currently 
		@if (Server::status())
			<span class="online">online</span>.<br>
		
			There are <span style="color: #e6e6e6;">{{ Server::players() }}</span> out of 
			<span style="color: #e6e6e6;">{{ Server::maxPlayers() }}</span> players online.
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