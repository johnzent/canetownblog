<?php
include 'connection.php'; 
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
	, fld_useremail) 
VALUES 
	('$uname'
	,'$pword'
	,'$email')";
	// echo $sqlQuery."<br/>";
	

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
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="regstyle.css">
</head>
<body>
<!-- <form action="" method="POST">
Username: <input type="text" name="uname"><br/>
Password: <input type="password" name="pword"><br/>
Email: <input type="text" name="email"><br/>
<button type="submit" name="submit">Create Account</button>
</form>
 -->


<div class="container">
	<div class="back">
		<a href="index.php"><i class="far fa-times-circle"></i></a>
	</div>
	<div class="header">
 		<h1>Register</h1>
 	</div>
		<div class="main">		
			<form action="" method="POST">
				<span>
					<i class="fas fa-user"></i>
					<input type="text" placeholder="Username"name="uname"><br/>

				</span><br>
				<span>
					<i class="fa fa-lock"></i>
					<input type="password" placeholder="Password" name="pword"><br/>
				</span><br>
				<span>
					<i class="fas fa-envelope"></i>
					<input type="text" placeholder="Email" name="email"><br/>
				</span><br>
				<button type="submit" name="submit">Sign Up</button><br>
				<label >Already have an account?</label><br>
				<a href="login.php">Login</a><br>
			</form>
		</div>
	</div>
<?php
if (isset($_POST['submit'])) {
	echo "<h1>$resultMessage</h1>";
}
?>
<a href="index.php">back</a>
</body>
</html>