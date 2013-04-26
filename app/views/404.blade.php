<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<style>
		body
		{
			font-family: "Trebuchet MS", Calibri, sans-serif;
			font-size: 14px;
		}
		section#wrapper
		{
			margin: 40px auto;
			display: block;
			width: 60%;
		}
		section#wrapper h1
		{
			padding: 0;
			margin: 0;
		}
		section#wrapper code
		{
			border-left: 4px solid #c0b587;
			background-color: #ece3c1;
			color: #504c3c;
			display: block;
			padding: 8px;
		}
	</style>

	<title>Missing Page</title>
</head>
<body>

	<section id="wrapper">
		<h1>Missing Page</h1>
		<p>It appears that the page you were trying to visit does not exist.</p>

		<code>{{ URL::current() }}</code>
	</section>

</body>
</html>