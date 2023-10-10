<?php
	include "core/functions.php";

	if($_POST)
	{
		$username = substr(strtolower($_POST["username"]), 0, 16);
		$password = substr($_POST["password"], 0, 256);

		$sta = $con->prepare("SELECT password FROM accounts WHERE username=:username");
		$sta->execute(array(':username' => $username));
		$fetchedpassword = $sta->fetch()["password"];

		if(password_verify($password, $fetchedpassword))
		{
			$sta = $con->prepare("SELECT uid FROM accounts WHERE username=:username");
			$sta->execute(array(':username' => $username));
			$uid = $sta->fetch()["uid"];

			$_SESSION["uid"] = $uid;
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $fetchedpassword;

			header("Location: $mainpage");
			die();
		}
	}
?>

<html>
	<head>
		<title>login</title>
		<link rel="icon" href="core/meiware.png">
		<link rel="stylesheet" href="core/stylesheet.css">
	</head>

	<header>
		<a href="index.php"><img src="core/meiware.png" style="width: 8vh; height: 8vh; line-height: 10vh;">eiware</a>
	</header>

	<div id="spacer"></div>

	<nav>
		<a href="home.php">home</a><a href="users.php">users</a>[<a href="login.php">login</a>/<a href="register.php">register</a>]
	</nav>

	<div id="spacer"></div>

	<body>
		<div id="content">
			<div id="spacer"></div>

			<form method="POST">
				username<br>
				<input type="text" name="username" maxlength="16">

				<div id="spacer"></div>

				password<br>
				<input type="password" name="password" maxlength="256">

				<div id="spacer"></div>

				<input type="submit" value="login">
			</form>

			<div id="spacer"></div>
		</div>
	</body>

	<div id="spacer"></div>

	<footer>
		&copy; <?php echo date("Y") . " Meiware"; ?>
	</footer>
</html>