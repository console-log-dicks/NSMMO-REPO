<?php
// TODO: maak hier een template van!!!
session_start();

require_once('../backend/config.php');
global $dbserver;
global $dbpassword;
global $dbusername;
global $db;

if (isset($_SESSION['time']))
{
	$sessioncheck = time() - $_SESSION['time'];
	echo "$sessioncheck";

	$_SESSION['time'] = time();
	$id = $_SESSION['id'];
	$activity = $_SESSION['time'];

	$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);
	if ($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}

	$updatesessiontime = $conn->prepare("UPDATE userdata SET activity=? WHERE id=?");
	$updatesessiontime->bind_Param("ss", $activity, $id);
	$updatesessiontime->execute();

	if ($sessioncheck > 60)
	{
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="refresh" content="2;Homepage.php">
			</head>
		</html>
		<?php
		die("you have been logged out");
	}
}
else
{
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="refresh" content="2;Homepage.php">
		</head>
	</html>
	<?php
	die("you have been logged out");
}


if (isset($_SESSION['username']))
{
	$username = $_SESSION['username'];
	echo $_SESSION['username'];
	echo $_SESSION['id'];

}
else
{
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta http-equiv="refresh" content="2;Homepage.php">
		</head>
	</html>
	<?php
	die("you have been logged out");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Village</title>
	</head>
	<body>
		<a href="Homepage.php">log out</a>
		<a href="Map.php">map</a>
	</body>
</html>
