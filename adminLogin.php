<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include 'connection.php'; 

//day 21 discussion

$headerLoc = "adminLogin.php?login=failed";

if (isset($_POST['submit'])) {
	$uname=$mysqli->real_escape_string($_POST['uname']);
	$pword=$mysqli->real_escape_string($_POST['pword']);

	$pword = sha1($pword);

	$sqlQuery = "SELECT COUNT(*), fld_uid, fld_act_type FROM tbl_login WHERE fld_username='$uname' AND fld_password='$pword' AND fld_act_type = 'admin' LIMIT 0,1";
	//echo "$sqlQuery";
	$result = $mysqli->query($sqlQuery);
	$row = $result->fetch_array();
	
	if ($row[0] == 1) {
		$_SESSION['id'] = $row[1];
		$_SESSION['uname'] = $uname;
		$_SESSION['account'] = $row[2];
		$headerLoc = "adminDashboard.php"; //fill correct filename later
	}

	header("Location: $headerLoc");
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
<button type="submit" name="submit">LOGIN</button>
</form>
<?php
if (isset($_GET['login'])) {
	echo "<h3>".$_GET['login']."</h3>";
}
?>
<a href="index.php">back</a>
</body>
</html>
