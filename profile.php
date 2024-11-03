<?
	include "core/functions.php";

	if(IsValidSession())
	{
		$sta = $con->prepare("SELECT * FROM accounts WHERE id=:id");
		$sta->execute(array(':id' => $_GET["id"]));
		$accountInfo = $sta->fetch();

		$avatarURL = file_exists("photos/" . $accountInfo["username"] . ".png") ? "photos/" . $accountInfo["username"] . ".png" : "core/logo.png";

		echo '
			<html>
				<head>
					<title>profile</title>
					<link rel="icon" href="core/logo.png">
					<link rel="stylesheet" href="core/stylesheet.css">
				</head>

				<header>
					<img src="core/logo.png" style="width: 6vh; height: 6vh;">' . substr($domain, 1) . '<a href="tickets.php">tickets</a><a href="team.php">team</a><a href="settings.php">settings</a><a href="logout.php">logout</a>
				</header>

				<body>
					<div id="content">
						<table>
							<tr><td><img src="' . $avatarURL . '" style="width: 16vh; height: 16vh; object-fit: cover;"></td></tr>
							<tr><td>' . $accountInfo["name"] . '</td></tr>
							<tr><td>' . $accountInfo["title"] . '</tr></td>
							<tr><td>' . $accountInfo["timestamp"] . ' UTC</td></tr>
							<tr><td>' . $accountInfo["username"] . '@mayware.net</td></tr>
						</table>
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