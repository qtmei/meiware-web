<?php
	/*
	<config>
	*/
	$DBhost = "localhost";
	$DBport = 3306;
	$DBuser = "user";
	$DBpass = "password";
	$DB = "mayware";
	/*
	</config>
	*/

	$domain = $_SERVER["SERVER_NAME"] == "mayware.net" ? "Mayware" : "Meiware";

	session_start();

	$con = new PDO("mysql:host=$DBhost;port=$DBport;dbname=$DB;charset=utf8", "$DBuser", "$DBpass");
	$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

	function IsValidSession()
	{
		global $con;
		$loggedin = false;

		if(isset($_SESSION["username"]) && isset($_SESSION["password"]))
		{
			$sta = $con->prepare("SELECT password FROM accounts WHERE username=:username");
			$sta->execute(array(':username' => $_SESSION["username"]));
			$password = $sta->fetch()["password"];

			if($_SESSION["password"] == $password)
			{
				$loggedin = true;
			}
			else
			{
				session_unset();
				session_destroy();
				header("Location: login.php");
				exit();
			}
		}

		return $loggedin;
	}
?>