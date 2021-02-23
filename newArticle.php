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
		<div class="container">
			<div class="post">			
				<form action="newArticleCode.php" method="post" enctype="multipart/form-data">
					Title:<br/><textarea name="title" cols="75" rows="8"></textarea><br/>
					Content:<br/>
					<textarea name="content" cols="75" rows="8"></textarea><br/>
					Select image to upload:<br/>
					<input type="file" name="fileToUpload" id="fileToUpload"><br/>
					<input type="submit" value="Upload Image" name="submit">
				</form>
		</div>
		</div>

  

</section>



<?php
if (isset($_GET['result'])) {
	echo $_GET['result'];
}
?>

</body>
</html>