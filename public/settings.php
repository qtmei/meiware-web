<?php
	include "functions.php";

	if(IsValidSession())
	{
		$sta = $con->prepare("SELECT * FROM accounts WHERE uid=:uid");
		$sta->execute(array(':uid' => $_SESSION["uid"]));
		$accountinfo = $sta->fetch();

		$sta = $con->prepare("SELECT * FROM profiles WHERE uid=:uid");
		$sta->execute(array(':uid' => $_SESSION["uid"]));
		$profileinfo = $sta->fetch();

		if($_POST)
		{
			$newusername = htmlspecialchars(substr(strtolower($_POST["username"]), 0, 16));
			$newpassword = htmlspecialchars(substr($_POST["password"], 0, 256));
			$newprofilename = htmlspecialchars(substr($_POST["profilename"], 0, 16));
			$newavatar = htmlspecialchars(substr($_POST["avatar"], 0, 256));
			$newinfo = htmlspecialchars(substr($_POST["info"], 0, 256));

			$sta = $con->prepare("SELECT username FROM accounts WHERE username=:username");
			$sta->execute(array(':username' => $newusername));
			$usernameres = $sta->rowCount();
			if($newusername != $accountinfo["username"] && $usernameres == 0)
			{
				$sta = $con->prepare("UPDATE accounts SET username=:username WHERE uid=:uid");
				$sta->execute(array(':username' => $newusername, ':uid' => $_SESSION["uid"]));

				$_SESSION["username"] = $newusername;
			}

			if($newpassword != $accountinfo["password"] && password_verify($newpassword, $accountinfo["password"]) == 0)
			{
				$sta = $con->prepare("UPDATE accounts SET password=:password WHERE uid=:uid");
				$sta->execute(array(':password' => password_hash($newpassword, PASSWORD_DEFAULT), ':uid' => $_SESSION["uid"]));

				$_SESSION["password"] = $newpassword;
			}

			$sta = $con->prepare("UPDATE profiles SET profilename=:profilename WHERE uid=:uid");
			$sta->execute(array(':profilename' => $newprofilename, ':uid' => $_SESSION["uid"]));

			$headers = get_headers($newavatar, 1);
			if(isset($headers["Content-Type"]))
			{
				if(strpos($headers["Content-Type"], "image/") !== FALSE)
				{
					$sta = $con->prepare("UPDATE profiles SET avatar=:avatar WHERE uid=:uid");
					$sta->execute(array(':avatar' => $newavatar, ':uid' => $_SESSION["uid"]));
				}
			}

			$sta = $con->prepare("UPDATE profiles SET info=:info WHERE uid=:uid");
			$sta->execute(array(':info' => $newinfo, ':uid' => $_SESSION["uid"]));

			header("Location: " . $_SERVER["REQUEST_URI"]);
			die();
		}

		echo '
				<html>
					<head>
						<title>settings</title>
						<link rel="icon" href="mayware.png?ts=' . time() . '">
						<link rel="stylesheet" href="stylesheet.css?ts=' . time() . '">
					</head>

					<header>
						<a href="index.php"><img src="mayware.png?ts=' . time() . '" style="width: 8vh; height: 8vh; line-height: 10vh;">ayware</a>
					</header>

					<div id="spacer"></div>

					<nav>
						<a href="users.php">users</a>
						<a href="settings.php">settings</a>
						<a href="logout.php">logout</a>
					</nav>

					<div id="spacer"></div>

					<body>
						<div id="content">
							<div id="spacer"></div>

							<table>
								<tr>
									<td><img src="' . $profileinfo["avatar"] . '" style="width: 16vh; height: 16vh; object-fit: cover;"></td>
								</tr>

								<tr>
									<td><a href="profile.php?uid=' . $accountinfo["uid"] . '">' . $profileinfo["profilename"] . '</a></td>
								</tr>

								<tr>
									<td>' . $accountinfo["timestamp"] . ' UTC</td>
								</tr>

								<tr>
									<td><pre>' . $profileinfo["info"] . '</pre></td>
								</tr>
							</table>

							<div id="spacer"></div>

							<form method="POST">
								<b>update</b><br>

								username<br>
								<input type="text" name="username" maxlength="16" value="' . $accountinfo["username"] . '">

								<div id="spacer"></div>

								password<br>
								<input type="password" name="password" maxlength="256" value="' . $accountinfo["password"] . '">

								<div id="spacer"></div>

								profilename<br>
								<input type="text" name="profilename" maxlength="16" value="' . $profileinfo["profilename"] . '">

								<div id="spacer"></div>

								avatar<br>
								<input type="text" name="avatar" maxlength="256" value="' . $profileinfo["avatar"] . '">

								<div id="spacer"></div>

								info<br>
								<textarea name="info" maxlength="256" rows="4">' . $profileinfo["info"] . '</textarea>

								<div id="spacer"></div>

								<input type="submit" value="update">
							</form>

							<div id="spacer"></div>
						</div>
					</body>

					<div id="spacer"></div>

					<footer>
						&copy; ' . date("Y") . ' Mayware
					</footer>
				</html>
		';
	}
?>
