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
// day 21 code
if (isset($_POST['submit'])) {
	$pword1=$mysqli->real_escape_string($_POST['pword1']);
	$pword2=$mysqli->real_escape_string($_POST['pword2']);
	$acttype=$mysqli->real_escape_string($_POST['acttype']);
	$uid=$mysqli->real_escape_string($_POST['uid']);

	$runQuery=true;
	$resultMessage="";

	if ($pword1 != $pword2) {
		$runQuery=false;
		$resultMessage.="Password is not identical<br/>";
	}

	if (empty($pword1) 
		|| (strlen(trim($pword1)) < 8)) {
		$runQuery=false;
		$resultMessage.="Password not valid<br/>";
	} else {
		$pword1 = sha1($pword1);
	}
	//magiging update query
	$sqlQuery="UPDATE tbl_login
	SET fld_password = '$pword1'
		, fld_act_type = '$acttype' 
	WHERE 
		fld_uid = '$uid'";


	if ($runQuery) {
		$result = $mysqli->query($sqlQuery);
		if ($result) {
			$resultMessage="Success";
		} else {
			$resultMessage.="Failed";
		}
	}
	header("Location: adminDashboard.php?result=$resultMessage");
}
$uid = 0;
if (isset($_GET['id'])) {
	$uid = $mysqli->real_escape_string($_GET['id']);

	$sqlQueryFill = "SELECT fld_act_type FROM tbl_login WHERE fld_uid = $uid LIMIT 0,1";
echo $sqlQueryFill;
	$resultFill = $mysqli->query($sqlQueryFill);

	$rowFill = $resultFill->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="" method="POST">
<h2>Please enter new password:</h2>
Password: <input type="password" name="pword1"><br/>
Repeat Password: <input type="password" name="pword2"><br/>
Account Type: 
<select name="acttype">
	<option value="reader" <?php
if (isset($_GET['id'])) {
	if ($rowFill['fld_act_type'] == 'reader') {
		echo "selected";
	}

}
	?>>Reader</option>
	<option value="editor" <?php
if (isset($_GET['id'])) {
	if ($rowFill['fld_act_type'] == 'editor') {
		echo "selected";
	}
}
	?>>Editor</option>
</select>
<input type="hidden" name="uid" value="<?php
if (isset($_GET['id'])) {
	echo $uid;
}
	?>">
<button type="submit" name="submit">Make Changes</button>
</form>
<?php
if (isset($_POST['submit'])) {
	echo "<h1>$resultMessage</h1>";
}
?>
<a href="adminDashboard.php">back</a>
</body>
</html>