<?
	include "core/functions.php";

	if(IsValidSession())
	{
		$sta = $con->prepare("SELECT * FROM accounts WHERE id=:id");
		$sta->execute(array(':id' => $_SESSION["id"]));
		$accountInfo = $sta->fetch();

		if($_POST)
		{
			$newPassword = substr($_POST["new_password"], 0, 256);
			$confirmPassword = substr($_POST["confirm_password"], 0, 256);

			if($newPassword == $confirmPassword && strlen($newPassword) >= 8 && strlen(count_chars($newPassword, 3)) >= 4)
			{
				$sta = $con->prepare("UPDATE accounts SET password=:newPassword WHERE id=:id");
				$sta->execute(array(':newPassword' => password_hash($newPassword, PASSWORD_DEFAULT), ':id' => $_SESSION["id"]));

				$sta = $con->prepare("SELECT password FROM accounts WHERE id=:id");
				$sta->execute(array(':id' => $_SESSION["id"]));
				$fetchedPassword = $sta->fetch()["password"];

				$_SESSION["password"] = $fetchedPassword;

				echo "Password changed.";
			}
			else
			{
				echo "Passwords do not match or invalid password. Minimum requirements: 8 characters, 4 unique.";
			}
		}

		echo '
			<html>
				<head>
					<title>settings</title>
					<link rel="icon" href="core/logo.png">
					<link rel="stylesheet" href="core/stylesheet.css">
				</head>

				<header>
					<img src="core/logo.png" style="width: 6vh; height: 6vh;">' . substr($domain, 1) . '<a href="tickets.php">tickets</a><a href="team.php">team</a><a href="settings.php">settings</a><a href="logout.php">logout</a>
				</header>

				<body>
					<div id="content">
						<form method="POST">
							new password<br>
							<input type="password" name="new_password" maxlength="256"><br>
							confirm password<br>
							<input type="password" name="confirm_password" maxlength="256"><br>
							<br>
							<input type="submit" value="update">
						</form>
					</div>
				</body>

				<footer>
					&copy; ' . date("Y") . ' ' . $domain . '
				</footer>
			</html>
		';
	}
	else
	{
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/login.php");
		exit();
	}
?>