<?
	include "core/functions.php";

	if($_POST)
	{
		$company = htmlspecialchars(substr($_POST["company"], 0, 32));
		$job = htmlspecialchars(substr($_POST["job"], 0, 32));
		$name = htmlspecialchars(substr($_POST["name"], 0, 32));
		$email = htmlspecialchars(substr($_POST["email"], 0, 64));
		$phone = htmlspecialchars(substr($_POST["phone"], 0, 16));
		$message = htmlspecialchars(substr($_POST["message"], 0, 2048));

		if($name != "" && $company != "" && $job != "" && $email != "" && $phone != "" && $message != "")
		{
			$sta = $con->prepare("INSERT INTO tickets (company, job, name, email, phone, message) VALUES (:company, :job, :name, :email, :phone, :message)");
			$sta->execute(array(':company' => $company, ':job' => $job, ':name' => $name, ':email' => $email, ':phone' => $phone, ':message' => $message));

			echo "Request submitted. We will be in touch in 1-2 business days.";
		}
		else
		{
			echo "Your request has missing details and was not submitted.";
		}
	}
?>

<html>
	<head>
		<title>contact us</title>
		<meta name="title" content="<? echo $domain; ?> - Contact us">
		<meta name="description" content="Contact us for personalized software with excellent optimization and security.">
		<link rel="icon" href="core/logo.png">

		<link rel="stylesheet" href="core/stylesheet.css">
	</head>

	<header>
		<img src="core/logo.png" style="width: 6vh; height: 6vh;"><? echo substr($domain, 1); ?><a href="/">home</a><a href="contact.php">contact us</a><a href="login.php">login</a>
	</header>

	<body>
		<div id="content">
			For consultation, quotes, or help, please fill out the form below.
			<br>
			<form method="POST">
				company<br>
				<input type="text" name="company" maxlength="32" required><br>
				job title<br>
				<input type="text" name="job" maxlength="32" required><br>
				full name<br>
				<input type="text" name="name" maxlength="32" required><br>
				email address<br>
				<input type="text" name="email" maxlength="64" required><br>
				phone number<br>
				<input type="text" name="phone" maxlength="16" required><br>
				message<br>
				<textarea id="message" name="message" maxlength="2048" wrap="soft" required></textarea><br>
				<br>
				<input type="submit" value="submit">
			</form>
		</div>
	</body>

	<footer>
		&copy; <? echo date("Y") . " " . $domain; ?>
	</footer>
</html>