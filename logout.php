<?php
	include "core/functions.php";

	session_unset();
	session_destroy();
	header("Location: $mainpage");
	die();
?>