<?php
	include "core/functions.php";

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
		<link rel="icon" href="core/meiware.png?ts=<?php echo time(); ?>">
		<link rel="stylesheet" href="core/stylesheet.css?ts=<?php echo time(); ?>">
	</head>

	<header>
		<a href="index.php"><img src="core/meiware.png?ts=<?php echo time(); ?>" style="width: 8vh; height: 8vh; line-height: 10vh;">eiware</a>
	</header>

	<div id="spacer"></div>

	<nav>
		<a href="home.php">home</a><a href="users.php">users</a><?php echo (IsValidSession()) ? '<a href="settings.php">settings</a><a href="logout.php">logout</a>' : '[<a href="login.php">login</a>/<a href="register.php">register</a>]'; ?>
	</nav>

	<div id="spacer"></div>

	<body>
		<div id="content">
			<div id="spacer"></div>

			<table>
				<tr><td><img src="<?php echo $profileinfo["avatar"]; ?>" style="width: 16vh; height: 16vh; object-fit: cover;"></td></tr>

				<tr><td><a href="profile.php?uid=<?php echo $_GET["uid"]; ?>"><?php echo $profileinfo["profilename"]; ?> <img src="core/flags/<?php echo $accountinfo["country"]; ?>.png" style="height: 1.5vh;"></a></td></tr>

				<?php if($accountinfo["title"] != "") { echo "<tr><td>" . $accountinfo["title"] . "</tr></td>"; } ?>

				<tr><td><?php echo $accountinfo["timestamp"]; ?> UTC</td></tr>

				<tr><td><pre><?php echo $profileinfo["info"]; ?></pre></td></tr>
			</table>

			<div id="spacer"></div>
		</div>
	</body>

	<div id="spacer"></div>

	<footer>
		&copy; <?php echo date("Y") . " Meiware"; ?>
	</footer>
</html>