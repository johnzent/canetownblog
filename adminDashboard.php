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
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<a href='logout.php'>logout</a><br/>
<a href="editorRegister.php">Create Editor Account</a>
<table border="1">
	<tr>
		<td>Username</td>
		<td>Email</td>
		<td>Account Type</td>
		<td></td>
	</tr>
<?php
$sqlQuery = "SELECT * FROM tbl_login WHERE fld_act_type <> 'admin'";

$result = $mysqli->query($sqlQuery);
while ($row = $result->fetch_array()) {
	echo "<tr>";
	echo "<td>".$row['fld_username']."</td>";
	echo "<td>".$row['fld_useremail']."</td>";
	echo "<td>".$row['fld_act_type']."</td>";
	echo "<td><a href='upAccount.php?id=".$row['fld_uid']."'>Update Account</a></td>";
	echo "</tr>";
}
?>

</table>


<?php
if (isset($_GET['result'])) {
	echo "<h1>".$_GET['result']."</h1>";
}
?>
</body>
</html>