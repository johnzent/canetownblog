<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (isset($_SESSION['id']) && $_SESSION['account'] != "editor") {
	header("Location: viewBlog.php");
} elseif (!isset($_SESSION['id'])) {
	header("Location: logout.php");
}

include 'connection.php';

$target_dir = "blogPics/";
if (isset($_POST['submit'])) {
	$bid = $mysqli->real_escape_string($_POST['bid']);
	$prevPic = $mysqli->real_escape_string($_POST['prevPic']);
	$uid = $mysqli->real_escape_string($_SESSION['id']);

	$sqlQuery = "DELETE FROM tbl_blog 
		WHERE fld_bid = '$bid' && fld_uid = '$uid'";
		
	$result = $mysqli->query($sqlQuery);
	if ($result) {
		$resultMessage="ROW DELETED";
		unlink($target_dir.$prevPic);
	} else {
		$resultMessage="Delete Failed";
	}
	
	header("Location: viewBlog.php?result=$resultMessage");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="deleteArticle.css">
</head>
<body>
<a class="back" href="viewBlog.php"><i class="fas fa-arrow-circle-left"></i></a>
<?php
if (isset($_GET['id'])) {
	$bid = $mysqli->real_escape_string($_GET['id']);
	$uid = $mysqli->real_escape_string($_SESSION['id']);

	$sqlCount = "SELECT COUNT(*) FROM tbl_blog WHERE fld_bid = '$bid' && fld_uid = '$uid'";

	$resultC = $mysqli->query($sqlCount);

	$rowC = $resultC->fetch_row();

	if ($rowC[0] == 1) {
		$sqlQuery = "SELECT * FROM tbl_blog WHERE fld_bid = '$bid' && fld_uid = '$uid' LIMIT 0,1";
		
		$result = $mysqli->query($sqlQuery);

		$row = $result->fetch_array();
	}
}
?>
<div class='post'>
<h1><center>DELETE POST</center></h1>
<img src="<?php
if (isset($_GET['id']) && $rowC[0] == 1) {
	echo $target_dir.$row['fld_bpict'];
}
?>" align="right">
Title:<b>
<?php
if (isset($_GET['id']) && $rowC[0] == 1) {
	echo $row['fld_btitle'];
}
?>
</b><br/>
Content:<br/>
<?php
if (isset($_GET['id']) && $rowC[0] == 1) {
	echo $row['fld_bcontent'];
}
?>
<br/>
<br/>
<form action="" method="POST">
<input type="hidden" name="bid" value="<?php
if (isset($_GET['id']) && $rowC[0] == 1) {
	echo $row['fld_bid'];
}
?>">
<input type="hidden" name="prevPic" value="<?php
if (isset($_GET['id']) && $rowC[0] == 1) {
	echo $row['fld_bpict'];
}
?>">
<input type="submit" value="DELETE" name="submit">
</form>
</div>
<?php
?>

</body>
</html>