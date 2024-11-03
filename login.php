<?
	include "core/functions.php";

	if($_POST)
	{
		$username = substr(strtolower($_POST["username"]), 0, 16);
		$password = substr($_POST["password"], 0, 256);

		$sta = $con->prepare("SELECT password FROM accounts WHERE username=:username");
		$sta->execute(array(':username' => $username));
		$fetchedPassword = $sta->fetch()["password"];

		if(password_verify($password, $fetchedPassword))
		{
			$sta = $con->prepare("SELECT id FROM accounts WHERE username=:username");
			$sta->execute(array(':username' => $username));
			$id = $sta->fetch()["id"];

			$_SESSION["id"] = $id;
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $fetchedPassword;

			header("Location: http://" . $_SERVER["HTTP_HOST"] . "/tickets.php");
			exit();
		}
		else
		{
			echo "Wrong password.";
		}
	}
?>

<html>
	<head>
		<title>login</title>
		<link rel="icon" href="core/logo.png">
		<link rel="stylesheet" href="core/stylesheet.css">
	</head>

	<header>
		<img src="core/logo.png" style="width: 6vh; height: 6vh;"><? echo substr($domain, 1); ?><a href="/">home</a><a href="contact.php">contact us</a><a href="login.php">login</a>
	</header>

	<body>
		<div id="content">
			<form method="POST">
				username<br>
				<input type="text" name="username" maxlength="16" required><br>
				password<br>
				<input type="password" name="password" maxlength="256" required><br>
				<br>
				<input type="submit" value="login">
			</form>
		</div>
	</body>

	<footer>
		&copy; <? echo date("Y") . " " . $domain; ?>
	</footer>
</html>