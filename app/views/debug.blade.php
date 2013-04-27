<style>
	section#debug-wrapper
	{
		-webkit-box-shadow: 0 3px 5px #333;
		-moz-box-shadow: 0 3px 5px #333;
		position: absolute !important;
		border-bottom: 1px solid #999;
		box-shadow: 0 3px 5px #333;
		z-index: 9999 !important;
		background-color: #fff;
		color: #666 !important;
		right: 0 !important;
		left: 0 !important;
		top: 0 !important;
		display: block;
		padding: 15px;
	}
	section#debug-wrapper.bottom
	{
		top: auto !important;
		bottom: 0 !important;
	}
	section#debug-wrapper h1
	{
		font-size: 18px;
		margin: 0 0 10px;
		padding: 0;
	}
	section#debug-wrapper blockquote
	{
		border: none;
		border-left: 4px solid #c3ba8a;
		background-color: #f4eeca;
		font-family: sans-serif;
		text-shadow: none;
		margin: 10px 0 0;
		font-size: 12px;
		padding: 10px;
		color: #333;
	}
</style>

<section id="debug-wrapper">
	<h1> pandaac :: debug monitor </h1>

	@foreach ($arguments as $argument)
		<blockquote>{{ var_dump($argument) }}</blockquote>
	@endforeach
</section>