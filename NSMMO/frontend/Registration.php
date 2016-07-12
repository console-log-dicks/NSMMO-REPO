<?php
// destroy session (make user log out)
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>NSMMO</title>
		<link rel="stylesheet" type="text/css" href="css/default.css">
	</head>
	<body>
		<form action="../backend/registration-handling.php" method="POST">
				<input type="text" id="username" name="username" placeholder="username" required>
				<br />
			<br />
				<input type="password" id="password" name="password" placeholder="password" required>
			<br />
			<br />
			<input type="submit" id="submit" name="submit" value="create account">
		</form>
	</body>
</html>
