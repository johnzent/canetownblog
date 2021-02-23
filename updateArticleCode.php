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
$newImage = "NO";
$picName=round(microtime(true)) . basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . round(microtime(true)) . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $newImage = $_POST['newImage'];
  $title = $mysqli->real_escape_string($_POST['title']);
  $content = $mysqli->real_escape_string($_POST['content']);
  $bid = $mysqli->real_escape_string($_POST['bid']);
  $uid = $mysqli->real_escape_string($_SESSION['id']);
  $prevPic = $mysqli->real_escape_string($_POST['prevPic']);

  if ($newImage == 'YES') {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $result.="File is an image - " . $check["mime"] . ".<br/>";
      $uploadOk = 1;
    } else {
      $result.="File is not an image.<br/>";
      $uploadOk = 0;
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

        $sqlUpdate="UPDATE tbl_blog 
        SET fld_btitle='$title'
        ,fld_bcontent='$content'
        ,fld_bpict='$picName'
        ,fld_bdate= NOW() 
        WHERE fld_bid = '$bid' && fld_uid = '$uid'";
        
        // echo $sqlUpdate; 
        if ($queryResult = $mysqli->query($sqlUpdate)) {
          $result.="File Upload recorded on database<br/>";
          unlink($target_dir.$prevPic);
        }
        $result.="The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.<br/>";
      } else {
        $result.="Sorry, there was an error uploading your file.<br/>";
      }
    }
  } else {
    $sqlUpdate="UPDATE tbl_blog 
    SET fld_btitle='$title'
    ,fld_bcontent='$content'
    ,fld_bdate= NOW() 
    WHERE fld_bid = '$bid' && fld_uid = '$uid'";
    if ($queryResult = $mysqli->query($sqlUpdate)) {
      $result ="Blog Post Updated<br/>";
    }
  }
}
// echo $result;
header("Location: viewBlog.php?result=$result");
?>