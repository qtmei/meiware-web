<?php
	include "core/functions.php";
?>

<html>
	<head>
		<title>home</title>
		<link rel="icon" href="core/meiware.png">
		<link rel="stylesheet" href="core/stylesheet.css">
	</head>

	<header>
		<a href="/"><img src="core/meiware.png" style="width: 8vh; height: 8vh; line-height: 10vh;">eiware</a>
	</header>

	<div id="spacer"></div>

	<nav>
		<a href="/">home</a><a href="users.php">users</a><?php echo (IsValidSession()) ? '<a href="settings.php">settings</a><a href="logout.php">logout</a>' : '[<a href="login.php">login</a>/<a href="register.php">register</a>]'; ?>
	</nav>

	<div id="spacer"></div>

	<body>
		<div id="content">
			<div id="spacer"></div>

			Meiware is an impossible to detect CS2 cheat that reads memory outside of a hypervisor running CS2.<br>
			it simulates mouse movement and key press, it does not write memory.<br>
			all graphical components are drawn outside of the hypervisor on top, so it is streaming compatible.<br>
			features: aimbot, triggerbot, chams, esp, bhop<br>

			<img src="core/screenshot.png" style="width: 75vw;">

			<div id="spacer"></div>
		</div>
	</body>

	<div id="spacer"></div>

	<footer>
		&copy; <?php echo date("Y") . " Meiware"; ?>
	</footer>
</html>