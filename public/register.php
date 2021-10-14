<?php
	include "../private/config.php";

	session_start();

	if($_POST)
	{
		$username = htmlspecialchars(substr(strtolower($_POST["username"]), 0, 16));
		$password = password_hash(htmlspecialchars(substr($_POST["password"], 0, 256)), PASSWORD_DEFAULT);

		$con = new PDO("mysql:host=$DBhost;port=$DBport;dbname=$DB;charset=utf8", "$DBuser", "$DBpass");
		$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		$sta = $con->prepare("SELECT username FROM accounts WHERE username=:username");
		$sta->execute(array(':username' => $username));
		$usernameres = $sta->rowCount();

		if($usernameres == 0)
		{
			$sta = $con->prepare("INSERT INTO accounts (username, password) VALUES (:username, :password)");
			$sta->execute(array(':username' => $username, ':password' => $password));

			$sta = $con->prepare("INSERT INTO profiles (profilename, avatar, info) VALUES (:username, 'mayware.png', '')");
			$sta->execute(array(':username' => $username));

			header("Location: login.php");
			die();
		}
	}
?>

<html>
	<head>
		<title>register</title>
		<link rel="icon" href="mayware.png?ts=<?php echo time(); ?>">
		<link rel="stylesheet" href="stylesheet.css?ts=<?php echo time(); ?>">
	</head>

	<header>
		<a href="index.php"><img src="mayware.png?ts=<?php echo time(); ?>" style="width: 8vh; height: 8vh; line-height: 10vh;">ayware</a>
	</header>

	<div id="spacer"></div>

	<nav>
		<a href="users.php">users</a>
		[<a href="login.php">login</a>/<a href="register.php">register</a>]
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

				<input type="submit" value="register">
			</form>

			<div id="spacer"></div>
		</div>
	</body>

	<div id="spacer"></div>

	<footer>
		&copy; <?php echo date("Y") . " Mayware"; ?>
	</footer>
</html>
