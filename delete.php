<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_GET['id'])) {
include "connection.php";
$id = $mysqli->real_escape_string($_GET['id']);
$sqlSelectRow = "SELECT *
FROM `tblEmployee`
WHERE Emp_ID = $id";
//echo $sqlSelectRow;
$result = $mysqli->query($sqlSelectRow);
$row = $result->fetch_assoc();
}
?>
<table border="2">
<tr>
 <td>Name:</td>
 <td>
 <?php if (isset($_GET['id'])) {
 echo $row['Emp_Name'];
 }?>
 </td>
</tr>
<tr>
 <td>Age:</td>
 <td>
 <?php if (isset($_GET['id'])){ echo $row['Emp_Age'];}
?>
 </td>
</tr>
<tr>
 <td>Position:</td>
 <td>
 <?php if (isset($_GET['id'])){echo $row['Position'];}
?>
 </td>
</tr>
<tr>
 <td>Salary:</td>
 <td>
 <?php if (isset($_GET['id'])){echo $row['Salary'];} ?>
 </td>
</tr>
</table>
<form method="GET" action="">
<input type="submit" name="submit" value="Yes">
<input type="submit" name="submit" value="No"><br><br>
<button><a href="view.php">Back</button>
<br><br>
<input type="hidden" name="id"
value="<?php
echo (isset($_GET['id'])) ? $row['Emp_ID']:'';
?>">
</form>


<?php
if (isset($_GET['submit']) && $_GET['submit'] == 'Yes') {
include "connection.php";
$id = $mysqli->real_escape_string($_GET['id']);
$sqlUpdate = "DELETE FROM tblEmployee
WHERE Emp_ID = '$id'";
if ($mysqli->query($sqlUpdate)) {
echo "Row Deleted";
} else {
echo "Delete failed";
}
} elseif (isset($_GET['submit']) && $_GET['submit'] == 'No')
{
echo "Delete Cancelled";
}
?>


    
</body>
</html>