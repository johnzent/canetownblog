<?php
include 'connection.php'; 
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['id'])) {
	header("Location: logout.php");
}

$oldErr =  $passErr = $cpassErr = $failedErr= $successErr="";
if (isset($_POST['submit'])) {
	$oldPass = $mysqli->real_escape_string($_POST['oldPass']);
	$newPass1 = $mysqli->real_escape_string($_POST['newPass1']);
	$newPass2 = $mysqli->real_escape_string($_POST['newPass2']);
	$uid=$mysqli->real_escape_string($_SESSION['id']);


$runQuery=true;



if (empty($oldPass) 
|| (strlen(trim($oldPass)) < 8)) {
$runQuery=false;
$oldErr.="Password not valid<br/>";
} else {
$oldPass = sha1($oldPass);
}

if ($newPass1 != $newPass2) {
$runQuery=false;
$cpassErr.="Password is not identical<br/>";
}

if (empty($newPass1) 
|| (strlen(trim($newPass1)) < 8)) {
$runQuery=false;
$passErr.="Password not valid<br/>";
} else {
$newPass1 = sha1($newPass1);
}


//magiging update query
$sqlQuery="UPDATE tbl_login
SET fld_password = '$newPass1'
WHERE 
fld_uid = '$uid'
AND fld_password = '$oldPass'";


if ($runQuery) {
$result = $mysqli->query($sqlQuery);
if ($result) {
	$successErr="Success";
} else {
	$failedErr.="Failed";
}
}

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="changePass.css">
</head>
<body>
	<div class="container">
	<div class="back">
		<a href="dashboard.php"><i class="far fa-times-circle"></i></a>
	</div>
	<div class="header">
 		<h3>Change Password</h3>
 	</div>
		<div class="main">		
			<form action="" method="POST">
				<span>
					<i class="fa fa-lock"></i>
					<input type="password" placeholder="Old Password"name="oldPass" required><br/>
				</span>
				<label for="oldPass">-<span class = "error"> <?php echo "$oldErr"; ?></label><br>
				<span>
					<i class="fa fa-lock"></i>
					<input type="password" placeholder="New Password" name="newPass1" required><br/>
				</span>
				<label for="newPass1">-<span class = "error"><?php echo "$passErr"; ?></label><br>
				<span>
					<i class="fa fa-lock"></i>
					<input type="password" placeholder="Confirm Password" name="newPass2" required><br/>
				</span>
				<label for="newPass2">-<span class = "error"><?php echo "$cpassErr"; ?></label><br>
				<button type="submit" name="submit">Submit</button>
				<label><br>
		<span class="success">
			<?php
					echo "<label> $failedErr$successErr</label>" ;
			?>
			</span>
			</label>
			</form>
		</div>
	</div>


</body>
</html>