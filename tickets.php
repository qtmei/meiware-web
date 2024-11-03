<?
	include "core/functions.php";

	if(IsValidSession())
	{
		$sta = $con->prepare("SELECT * FROM tickets");
		$sta->execute();
		$html = "";

		while($row = $sta->fetch())
		{
			$html .= '<tr><td><a href="ticket.php?id=' . $row["id"] . '">' . $row["timestamp"] . ' UTC, ' . $row["company"] . ', ' . $row["job"] . ', ' . $row["name"] . '</a></td></tr>';
		}

		echo '
			<html>
				<head>
					<title>tickets</title>
					<link rel="icon" href="core/logo.png">
					<link rel="stylesheet" href="core/stylesheet.css">
				</head>

				<header>
					<img src="core/logo.png" style="width: 6vh; height: 6vh;">' . substr($domain, 1) . '<a href="tickets.php">tickets</a><a href="team.php">team</a><a href="settings.php">settings</a><a href="logout.php">logout</a>
				</header>

				<body>
					<div id="content">
						<table>
							' . $html . '
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