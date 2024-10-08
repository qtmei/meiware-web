<?php
	include "core/functions.php";

	if($_POST) {
		$username = htmlspecialchars(substr(strtolower($_POST["username"]), 0, 16));
		$password = substr($_POST["password"], 0, 256);
		$passwordconfirm = substr($_POST["passwordconfirm"], 0, 256);
		$invitecode = substr($_POST["invitecode"], 0, 16);

		$sta = $con->prepare("SELECT username FROM accounts WHERE username=:username");
		$sta->execute(array(':username' => $username));
		$usernameres = $sta->rowCount();

		$sta = $con->prepare("SELECT code FROM invites WHERE code=:code");
		$sta->execute(array(':code' => $invitecode));
		$invitecoderes = $sta->rowCount();

		if($usernameres == 0 && $password == $passwordconfirm && $invitecoderes == 1) {
			$sta = $con->prepare("INSERT INTO accounts (username, password, country) VALUES (:username, :password, :country)");
			$sta->execute(array(':username' => $username, ':password' => password_hash($password, PASSWORD_DEFAULT), ':country' => file_get_contents("http://ipinfo.io/" . getIP() . "/country")));

			$sta = $con->prepare("INSERT INTO profiles (profilename, avatar, info) VALUES (:username, 'core/meiware.png', '')");
			$sta->execute(array(':username' => $username));

			$sta = $con->prepare("DELETE FROM invites WHERE code=:code");
			$sta->execute(array(':code' => $invitecode));

			header("Location: login.php");
			exit();
		}
	}
?>

<html>
	<head>
		<title>register</title>
		<link rel="icon" href="core/meiware.png">
		<link rel="stylesheet" href="core/stylesheet.css">
	</head>

	<header>
		<a href="/"><img src="core/meiware.png" style="width: 8vh; height: 8vh; line-height: 10vh;">eiware</a>
	</header>

	<div id="spacer"></div>

	<nav>
		<a href="/">home</a><a href="users.php">users</a>[<a href="login.php">login</a>/<a href="register.php">register</a>]
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

				confirm password<br>
				<input type="password" name="passwordconfirm" maxlength="256">

				<div id="spacer"></div>

				invite code<br>
				<input type="password" name="invitecode" maxlength="256">

				<div id="spacer"></div>

				<input type="submit" value="register">
			</form>

			<div id="spacer"></div>
		</div>
	</body>

	<div id="spacer"></div>

	<footer>
		&copy; <?php echo date("Y") . " Meiware"; ?>
	</footer>
</html>