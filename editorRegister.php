<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (isset($_SESSION['id']) && $_SESSION['account'] != "admin") {
	header("Location: viewBlog.php");
} elseif (!isset($_SESSION['id'])) {
	header("Location: logout.php");
}

include 'connection.php'; 
//day 21 codes
if (isset($_POST['submit'])) {
$uname=$mysqli->real_escape_string($_POST['uname']);
$pword=$mysqli->real_escape_string($_POST['pword']);
$email=$mysqli->real_escape_string($_POST['email']);

$runQuery=true;
$resultMessage="";

if (empty($uname) 
	|| (strlen(trim($uname)) < 8)) {
	$runQuery=false;
	$resultMessage.="Name not valid<br/>";
} else {
	$uname = strtolower($uname);
}

if (empty($pword) 
	|| (strlen(trim($pword)) < 8)) {
	$runQuery=false;
	$resultMessage.="Password not valid<br/>";
} else {
	$pword = sha1($pword);
}

if (empty($email) 
	|| (strlen(trim($email)) < 8)) {
	$runQuery=false;
	$resultMessage.="Email not valid<br/>";
}

$sqlCheckExist = "SELECT COUNT(*) FROM tbl_login WHERE fld_username = '$uname' OR fld_useremail = '$email'";

$resultCheck = $mysqli->query($sqlCheckExist);
$loginCheck = $resultCheck->fetch_row();

if ($loginCheck[0] > 0) {
	$runQuery=false;
	$resultMessage.="Username or Email is already used<br/>";
}


$sqlQuery="INSERT INTO tbl_login
	(fld_username
	, fld_password
	, fld_useremail
	, fld_act_type) 
VALUES 
	('$uname'
	,'$pword'
	,'$email'
	,'editor')";
	echo $sqlQuery."<br/>";

if ($runQuery) {
	$result = $mysqli->query($sqlQuery);
	if ($result) {
		$resultMessage="Success";
	} else {
		$resultMessage.="Failed";
	}
}
// header("Location: register.php?result=$resultMessage");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="" method="POST">
Username: <input type="text" name="uname"><br/>
Password: <input type="password" name="pword"><br/>
Email: <input type="text" name="email"><br/>
<button type="submit" name="submit">Create EDITOR Account</button>
</form>
<?php
if (isset($_POST['submit'])) {
	echo "<h1>$resultMessage</h1>";
}
?>
<a href="index.php">back</a>
</body>
</html>