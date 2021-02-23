<?php
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

if (!isset($_SESSION['id'])) {
	header("Location: logout.php");
}

include 'connection.php';

// day 21 code

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="dashboard.css">
</head>

<body>
<section>
<header>
 
 	<a href="index.php"><img class="logo" src="blogPics/loko.png"></a>

   <ul>  
   <?php
	if (isset($_SESSION['account'])) {?>
	 <li><a href="#"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['uname']?> <i class="fas fa-caret-down"></i></a></li>
	 <?php{ else {?>
	 <?php } ?>
	 	<ul>
		 <li><a href="viewBlog.php">View Blog</a></li>
			<li><a href="logout.php">Log out</a></li>
	 	</ul>
   </ul>
 </header>
<div class="table">
<?php
if (isset($_GET['result'])) {
	echo "<h1>".$_GET['result']."</h1>";
}

$subStrCharLimit = 100;
$uid = $mysqli->real_escape_string($_SESSION['id']);
if ($_SESSION['account'] == "editor") {
	echo "<a href='changePass.php'>Change Password</a><br><br>";
	echo "<a class='wala' href='newArticle.php'>Make new Article</a><br/><br>";
	echo "<h1>Articles Written</h1>";
	echo "<table border='1' class='bord'>
	<tr>
		<td>Title</td>
		<td>Picture</td>
		<td>Content</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>";

	$sqlGetArticle="SELECT 
			fld_bid
			, fld_btitle
			, SUBSTR(fld_bcontent, 1, $subStrCharLimit) AS 'content'
			, fld_bpict
			, fld_bdate
	 	FROM tbl_blog WHERE fld_uid='$uid'
	 	ORDER BY fld_bid DESC";
	$resultGetArticle = $mysqli->query($sqlGetArticle);
	while ($row = $resultGetArticle->fetch_assoc()) {
		echo "<tr>";
		echo "<td>".$row['fld_btitle']."</td>";
		echo "<td><img src='blogPics/".$row['fld_bpict']."' height='100' width='100'/></td>";
		echo "<td>".$row['content']." ...</td>";
		echo "<td><a href='viewArticle.php?id=".$row['fld_bid']."'>View Article</a></td>";
		echo "<td><a href='updateArticle.php?id=".$row['fld_bid']."'>Update</a></td>";
		echo "<td><a href='deleteArticle.php?id=".$row['fld_bid']."'>Delete</a></td>";
	
		echo "</tr>";
	}

	echo "</table>";
}
?>
</div>
<div class="comments">
<?php
echo "<h1>Comments Written</h1>";
echo "<table border='1'>
<tr>
	<td>Blog Title</td>
	<td>Comment</td>
	<td></td>
	<td></td>
	<td></td>
</tr>";

$subStrCharLimit = 100;
$uid = $mysqli->real_escape_string($_SESSION['id']);
$sqlGetFeedback="SELECT 
		fld_fid
		,tbl_blog.fld_bid
		,tbl_blog.fld_btitle
		, fld_feedback 
	FROM tbl_feedback 
	JOIN tbl_blog 
	ON tbl_feedback.fld_bid = tbl_blog.fld_bid
	WHERE tbl_feedback.fld_uid = '$uid'
	ORDER BY fld_fid DESC";
$resultGetFeedback = $mysqli->query($sqlGetFeedback);  
while ($rowGetFeedback = $resultGetFeedback->fetch_assoc()) {
	echo "<tr>";
	echo "<td>".$rowGetFeedback['fld_btitle']."</td>";
	echo "<td>".$rowGetFeedback['fld_feedback']."</td>";
	echo "<td><a href='viewArticle.php?id=".$rowGetFeedback['fld_bid']."'>View Article</a></td>";
	echo "<td><a href='upComment.php?id=".$rowGetFeedback['fld_bid']
		."&fid=".$rowGetFeedback['fld_fid']."'>Update</a></td>";
	echo "<td><a href='delComment.php?id=".$rowGetFeedback['fld_bid']
		."&fid=".$rowGetFeedback['fld_fid']."'>Delete</a></td>";
	echo "</tr>";
}

echo "</table>";
?>
</div>
</section>
</body>
</html>