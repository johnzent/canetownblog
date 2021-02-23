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
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="newArticle.css">
</head>
<body>
<section>
<header>
 
 <img class="logo" src="blogPics/loko.png">

<ul>  
<?php
if (isset($_SESSION['account'])) {?>
 <li><a href="#"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['uname']?> <i class="fas fa-caret-down"></i></a></li>
 <?php{ else {?>
 <?php } ?>
	 <ul>
		<li><a href="viewBlog.php">View Blog</a></li>
		<li><a href="dashboard.php">Dashboard</a></li>
		<li><a href="logout.php">Log out</a></li>
	 </ul>
</ul>
</header>
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
<div class="container">
	<div class="post">
<form action="updateArticleCode.php" method="post" enctype="multipart/form-data">
	Title: <input type="text" name="title" value="<?php
if (isset($_GET['id']) && $rowC[0] == 1) {
	echo $row['fld_btitle'];
}
	?>"><br/>
	Content:<br/>
	<textarea name="content" cols="75" rows="8"><?php
if (isset($_GET['id']) && $rowC[0] == 1) {
	echo $row['fld_bcontent'];
}
	?></textarea><br/>
	Previous Picture:<br/>
	<img src="blogPics/<?php
if (isset($_GET['id']) && $rowC[0] == 1) {
	echo $row['fld_bpict'];
}
	?>" height="300px"><br/>
	Upload a new image?
	<select name="newImage">
		<option selected>NO</option>
		<option>YES</option>
	</select><br/>
	Select image to upload:<br/>
	<input type="file" name="fileToUpload" id="fileToUpload"><br/>
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
	<input type="submit" value="UPDATE" name="submit">
</form>
</div>
</div>
</section>
</body>
</html>