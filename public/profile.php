<?php
	include "functions.php";

	$sta = $con->prepare("SELECT * FROM accounts WHERE uid=:uid");
	$sta->execute(array(':uid' => $_GET["uid"]));
	$accountinfo = $sta->fetch();

	$sta = $con->prepare("SELECT * FROM profiles WHERE uid=:uid");
	$sta->execute(array(':uid' => $_GET["uid"]));
	$profileinfo = $sta->fetch();
?>

<html>
	<head>
		<title>profile</title>
		<link rel="icon" href="mayware.png?ts=<?php echo time(); ?>">
		<link rel="stylesheet" href="stylesheet.css?ts=<?php echo time(); ?>">
	</head>

	<header>
		<a href="index.php"><img src="mayware.png?ts=<?php echo time(); ?>" style="width: 8vh; height: 8vh; line-height: 10vh;">ayware</a>
	</header>

	<div id="spacer"></div>

	<nav>
		<a href="users.php">users</a>
		<?php
			if(IsValidSession())
			{
				echo '
					<a href="settings.php">settings</a>
					<a href="logout.php">logout</a>
				';
			}
			else
			{
				echo '
					[<a href="login.php">login</a>/<a href="register.php">register</a>]
				';
			}
		?>
	</nav>

	<div id="spacer"></div>

	<body>
		<div id="content">
			<div id="spacer"></div>

			<table>
				<tr>
					<td><img src="<?php echo $profileinfo["avatar"]; ?>" style="width: 16vh; height: 16vh; object-fit: cover;"></td>
				</tr>

				<tr>
					<td><a href="profile.php?uid=<?php echo $_GET["uid"]; ?>"><?php echo $profileinfo["profilename"]; ?></a></td>
				</tr>

				<tr>
					<td><?php echo $accountinfo["timestamp"]; ?> UTC</td>
				</tr>

				<tr>
					<td><pre><?php echo $profileinfo["info"]; ?></pre></td>
				</tr>
			</table>

			<div id="spacer"></div>
		</div>
	</body>

	<div id="spacer"></div>

	<footer>
		&copy; <?php echo date("Y") . " Mayware"; ?>
	</footer>
</html>
