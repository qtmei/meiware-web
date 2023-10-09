<?php
	/*
	<config>
	*/
	$DBhost = "localhost";
	$DBport = 3306;
	$DBuser = "root";
	$DBpass = "";
	$DB = "meiware";

	$mainpage = "home.php"; //index.php redirect
	/*
	</config>
	*/

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
				die();
			}
		}

		return $loggedin;
	}

	function getIP()
	{
		if(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0)
			{
				$addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);

				return trim($addr[0]);
			}
			else
			{
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}
		else
		{
			return $_SERVER['REMOTE_ADDR'];
		}
	}
?>