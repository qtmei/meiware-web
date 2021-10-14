<?php
	include "functions.php";

	DestroySession();

	header("Location: $mainpage");
	die();
?>
