<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
include 'connection.php'; 

$failedErr ="";


$headerLoc = "login.php?login=failed";

if (isset($_POST['submit'])) {
	$uname=$mysqli->real_escape_string($_POST['uname']);
	$pword=$mysqli->real_escape_string($_POST['pword']);
	$acttype=$mysqli->real_escape_string($_POST['acttype']);

	$pword = sha1($pword);

	$sqlQuery = "SELECT COUNT(*), fld_uid, fld_act_type FROM tbl_login WHERE fld_username='$uname' AND fld_password='$pword' AND fld_act_type = '$acttype' LIMIT 0,1";
	//echo "$sqlQuery";
	$result = $mysqli->query($sqlQuery);
	$row = $result->fetch_array();
	
	if ($row[0] == 1) {
		$_SESSION['id'] = $row[1];
		$_SESSION['uname'] = $uname;
		$_SESSION['account'] = $row[2];
		$headerLoc = "viewBlog.php"; //fill correct filename later
	}

	header("Location: $headerLoc");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="loginstyle.css">
</head>
<body>
	<div class="container">
					<div class="back">
							<a href="index.php"><i class="far fa-times-circle"></i></a>
					</div>
					<div class="header">
						<h1>Login</h1>
					</div>
			<div class="main">		
				<form action="" method="POST">
				<?php
				if (isset($_GET['login'])) {
					$failedErr="Login Failed";
				}
				?>
					<span>
						<i class="fas fa-user"></i>
						<input type="text" placeholder="Username"name="uname"><br/>
					</span><br>
				
					<span>
						<i class="fa fa-lock"></i>
						<input type="password" placeholder="Password" name="pword"><br/>
					</span><br>
					<select name="acttype">
						<option value="reader"><i class="fas fa-user-check"></i>Reader</option>
						<option value="editor"><i class="fas fa-user-check">Editor</option>
					</select><br/>
					<button type="submit" name="submit">LOGIN</button><br>
					<label>-
						<span class="success">
					<?php
							echo " $failedErr" ;
					?>
					</span>
					</label><br>
					<label >Don't have an account?</label><br>
					<div class="sign"><a href="register.php">Sign Up</a><br></div>
				</form>
			</div>
	</div>





</body>
</html>
