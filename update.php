<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
    if (isset($_GET['id'])) {
    include "connection.php";
    $id = $mysqli->real_escape_string($_GET['id']);
    $sqlSelectRow = "SELECT *
    FROM `tblemployee`
    WHERE Emp_ID = $id";
    //echo $sqlSelectRow;
    $result = $mysqli->query($sqlSelectRow);
    $row = $result->fetch_assoc();
}
?>

</head>
<body>
<table>
<!-- Start of form -->
    <form method="GET" action="">
        <tr>
            <th>Name:</th>
            <td>
                <input type="text" name="name"
                value="<?php
                if (isset($_GET['id'])) {
                echo $row['Emp_Name'];
                }?>">
            </td>
        </tr> 
        <tr>
            <th>Age:</th>
            <td>
                <input type="text" name="age"
                value="<?php
                if (isset($_GET['id'])) {
                echo $row['Emp_Age'];
                }?>">
            </td>
        </tr>
        <tr>
            <th>Position:</th>
            <td>
                <input type="text" name="position"
                value="<?php
                if (isset($_GET['id'])) {
                echo $row['Position'];
                }?>">
            </td>
        </tr>
        <tr>
            <th>Salary:</th>
            <td>
                <input type="text" name="salary"
                value="<?php
                if (isset($_GET['id'])) {
                echo $row['Salary'];
                }?>">
            </td>
        </tr>
        
                <input type="hidden" name="id"
                value="<?php
                if (isset($_GET['id'])) {
                echo $row['Emp_ID'];
                }?>">
        <tr>
            <th colspan="2">
            <input type="submit" name="submit" value="Update">
            <input type="submit" name="submit" value="Cancel">
            </th>
        </tr>
        
        <button><a href="view.php">Back</a></button>
    </form>
</table>
<!-- End of form -->
<?php

if (isset($_GET['submit']) && $_GET['submit'] == 'Update') {
include "connection.php";
$name = $mysqli->real_escape_string($_GET['name']);
$age = $mysqli->real_escape_string($_GET['age']);
$position = $mysqli->real_escape_string($_GET['position']);
$salary = $mysqli->real_escape_string($_GET['salary']);
$id = $mysqli->real_escape_string($_GET['id']);
$sqlUpdate = "UPDATE tblemployee
SET
Emp_Name = '$name'
, Emp_Age = '$age'
, Position = '$position'
, Salary = '$salary'
WHERE
Emp_ID = '$id'";
if ($mysqli->query($sqlUpdate)) {
echo "Update success";
} else {
echo "Update failed";
}
} elseif (isset($_GET['submit']) && $_GET['submit'] =='Cancel') {
echo "Update Cancelled";
}
?>
</body>
</html>