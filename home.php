<?php
	include "core/functions.php";
?>

<html>
	<head>
		<title>home</title>
		<link rel="icon" href="core/meiware.png?ts=<?php echo time(); ?>">
		<link rel="stylesheet" href="core/stylesheet.css?ts=<?php echo time(); ?>">
	</head>

	<header>
		<a href="index.php"><img src="core/meiware.png?ts=<?php echo time(); ?>" style="width: 8vh; height: 8vh; line-height: 10vh;">eiware</a>
	</header>

	<div id="spacer"></div>

	<nav>
		<a href="home.php">home</a><a href="users.php">users</a><?php echo (IsValidSession()) ? '<a href="settings.php">settings</a><a href="logout.php">logout</a>' : '[<a href="login.php">login</a>/<a href="register.php">register</a>]'; ?>
	</nav>

	<div id="spacer"></div>

	<body>
		<div id="content">
			<div id="spacer"></div>

			Meiware is an impossible to detect CS2 cheat that reads memory outside of a hypervisor running CS2.</br>
			it simulates key press and does not write memory.</br>
			all graphical components are drawn outside of the hypervisor on top, so it is streaming compatible.</br>
			features include:</br>
			triggerbot</br>
			ESP(name, health)</br>
			chams(green visible, red invisible)</br>
			bhop

			<div id="spacer"></div>
		</div>
	</body>

	<div id="spacer"></div>

	<footer>
		&copy; <?php echo date("Y") . " Meiware"; ?>
	</footer>
</html>
