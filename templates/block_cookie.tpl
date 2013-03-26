<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Krusty Kookies</title>
</head>
<body>
	<hr>
	<p>Block another cookie here:</p>
	<ul>
	</ul>
<form action="/blocked" method="POST">
   Cookie name: 						<input type="text" name="cookie" id="cookie" />
   <br>
   Block until('yyyy-mm-dd hh:mm:ss'): 	<input type="text" name="end" id="end" />
   <br>
   <input type="submit" value="Block now" />
</form>
</body>
</html>