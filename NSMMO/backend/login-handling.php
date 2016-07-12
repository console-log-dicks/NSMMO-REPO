<?php
session_start();
require_once('config.php');

global $dbserver;
global $dbpassword;
global $dbusername;
global $db;

// create connection to db
$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);

// check connection
if ($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

// assign values from registration form to variables
$username = $_POST['username'];
$password = $_POST['password'];

// check whether username and password are correct
$comparelogin = $conn->prepare("SELECT password FROM users where username=?");
$comparelogin->bind_param("s", $username);
$comparelogin->execute();
$comparelogin->bind_result($result);
$comparelogin->fetch();

echo "result: ".$result;
echo "password: ".$password;

if ($result == $password)
{

}
else
{
	?>
		<script>
		alert("password and/or username is incorrect");
		</script>
		<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="refresh" content="0;../frontend/Homepage.php">
			</head>
		</html>
	<?php
  	return;
}

// set session
$_SESSION['username'] = $username;
echo $_SESSION['username'];

$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);
if ($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$getid = $conn->prepare("SELECT id FROM users where username=?");
$getid->bind_param("s", $username);
$getid->execute();
$getid->bind_result($id);
$getid->fetch();

$_SESSION['id'] = $id;

$_SESSION['time'] = time();
$activity = $_SESSION['time'];

$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);
if ($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$updatesessiontime = $conn->prepare("UPDATE userdata SET activity=? WHERE id=?");
$updatesessiontime->bind_Param("ss", $activity, $id);
$updatesessiontime->execute();


// redirect to village overview
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="refresh" content="0;../frontend/Villageoverview.php">
	</head>
</html>
