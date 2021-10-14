<?php
	include "../private/config.php";

	session_start();

	$con = new PDO("mysql:host=$DBhost;port=$DBport;dbname=$DB;charset=utf8", "$DBuser", "$DBpass");
	$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	function DestroySession()
	{
		session_unset();
		session_destroy();
	}

	function IsValidSession()
	{
		include "../private/config.php";

		$loggedin = false;

		$con = new PDO("mysql:host=$DBhost;port=$DBport;dbname=$DB;charset=utf8", "$DBuser", "$DBpass");
		$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
		{
			$sta = $con->prepare("SELECT password FROM accounts WHERE username=:username");
			$sta->execute(array(':username' => $_SESSION["username"]));
			$password = $sta->fetch()["password"];

			if(password_verify($_SESSION["password"], $password) == 1)
			{
				$loggedin = true;
			}
			else
			{
				session_unset();
				session_destroy();
			}
		}

		return $loggedin;
	}
?>
