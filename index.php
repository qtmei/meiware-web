<?
	include "core/functions.php";
?>

<html>
	<head>
		<title>home</title>
		<meta name="title" content="<? echo $domain; ?> - Home">
		<meta name="description" content="We provide you personalized software with excellent optimization and security.">
		<link rel="icon" href="core/logo.png">

		<link rel="stylesheet" href="core/stylesheet.css">
	</head>

	<header>
		<img src="core/logo.png" style="width: 6vh; height: 6vh;"><? echo substr($domain, 1); ?><a href="/">home</a><a href="contact.php">contact us</a><a href="login.php">login</a>
	</header>

	<body>
		<div id="content">
			We provide you personalized software with excellent optimization and security.<br>
			<br>
			Why you should choose us:<br>
			Lower rates than our competitors<br>
			Higher standards for optimization and security<br>
			24/7 Customer Support<br>
			<br>
			For consultation, quotes, or help, please visit our <a href="contact.php">contact</a> page.
		</div>
	</body>

	<footer>
		&copy; <? echo date("Y") . " " . $domain; ?>
	</footer>
</html>