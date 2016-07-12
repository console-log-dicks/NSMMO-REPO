<?php
require_once('config.php');

global $dbserver;
global $dbpassword;
global $dbusername;
global $db;

// assign values from registration form to variables
$username = $_POST['username'];
$password = $_POST['password'];

// security measurements !!!
preg_match('/\W/', $username, $chartest);
if ($chartest)
{
	var_dump('$chartest');
	die('please enter a valid username');
}
echo "$username";

// TODO: encrypt passord

// check is username is taken or Not
$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);
if ($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}
$compareusername = $conn->prepare("SELECT username FROM users where username=?");
$compareusername->bind_param("s", $username);
$compareusername->execute();
$compareusername->bind_result($error);
$compareusername->fetch();

if($error)
	{
		die("This username already exists");
	}



// insert data into db (table=users)
$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);
if ($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$createacc = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$createacc->bind_Param("ss", $username, $password);
$createacc->execute();

$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);
if ($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$getuserid = $conn->prepare("SELECT id FROM users where username=?");
$getuserid->bind_param("s", $username);
$getuserid->execute();
$getuserid->bind_result($id);
$getuserid->fetch();

$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);
if ($conn->connect_error)
{
	die("Connection failed: ".$conn->connect_error);
}

$createaccdata = $conn->prepare("INSERT INTO userdata (id) VALUES (?)");
$createaccdata->bind_Param("s", $id);
$createaccdata->execute();

echo "Account has been added successfully.";
?>
