<?
	include "core/functions.php";

	if(IsValidSession())
	{
		$sta = $con->prepare("SELECT * FROM tickets WHERE id=:id");
		$sta->execute(array(':id' => $_GET["id"]));
		$ticketInfo = $sta->fetch();

		echo '
			<html>
				<head>
					<title>ticket</title>
					<link rel="icon" href="core/logo.png">
					<link rel="stylesheet" href="core/stylesheet.css">
				</head>

				<header>
					<img src="core/logo.png" style="width: 6vh; height: 6vh;">' . substr($domain, 1) . '<a href="tickets.php">tickets</a><a href="team.php">team</a><a href="settings.php">settings</a><a href="logout.php">logout</a>
				</header>

				<body>
					<div id="content">
						<table>
							<tr><td>' . $ticketInfo["timestamp"] . ' UTC</td></tr>
							<tr><td>Company: ' . $ticketInfo["company"] . '</td></tr>
							<tr><td>Representative: ' . $ticketInfo["job"] . ', ' . $ticketInfo["name"] . '</td></tr>
							<tr><td>Contact: ' . $ticketInfo["email"] . ' , ' . $ticketInfo["phone"] . '</td></tr>
							<tr><td>Message: <pre>' . $ticketInfo["message"] . '</pre></td></tr>
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