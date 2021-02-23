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
// day 19 code

$result ="";
$picNotes="";
$target_dir = "blogPics/";
$picName=round(microtime(true)) . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . round(microtime(true)) . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    $result.="File is an image - " . $check["mime"] . ".<br/>";
    $uploadOk = 1;
  } else {
    $result.="File is not an image.<br/>";
    $uploadOk = 0;
  }
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 1500000) {
  $result.="Sorry, your file is too large.<br/>";
  $uploadOk = 0;
} 

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $result.="Sorry, your file was not uploaded.<br/>";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
  	$title = $mysqli->real_escape_string($_POST['title']);
  	$content = $mysqli->real_escape_string($_POST['content']);
  	$uid =  $mysqli->real_escape_string($_SESSION['id']);

    $sqlInsert="INSERT INTO tbl_blog(fld_btitle, fld_bcontent, fld_bpict, fld_uid) VALUES 
    	('$title', '$content', '$picName', '$uid')";
    
    // echo $sqlInsert; 
    if ($queryResult = $mysqli->query($sqlInsert)) {
      $result.="File Upload recorded on database<br/>";
    }
    $result.="The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.<br/>";
  } else {
    $result.="Sorry, there was an error uploading your file.<br/>";
  }
}
header("Location: newArticle.php?result=$result");
?>