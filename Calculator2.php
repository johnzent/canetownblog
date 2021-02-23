<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="activities.php">Back</a>
<form method="GET" action="">
    <input type="text" name="numA">
    <select name="operator">
    <option value="+">+</option>
    <option value="-">-</option>
    <option value="*">*</option>
    <option value="/">/</option>
    </select>
    <input type="text" name="numB">
    <input type="submit" name="submit" value="=">
 
</form>
<?php 
function calculate ($numA, $numB, $operator) {
    $result="";

    if($_GET['operator']=='+'){
    $result = $numA + $numB;
    
    }   
    elseif($_GET['operator']=='-'){
    $result = $numA - $numB; 
 
    }
    elseif($_GET['operator']=='*'){
    $result = $numA * $numB; 
   
    }
    elseif($_GET['operator']=='/'){
    $result = $numA / $numB; 
    
    }
    echo "$numA $operator $numB = $result ";
}


?>
<?php
if (isset($_GET['submit'])) {
    
    if(is_numeric($_GET['numA'])){
    $numA = $_GET['numA'];


        if(is_numeric($_GET['numB'])){
        $numB = $_GET['numB'];
 
        $operator = $_GET['operator'];
   
        echo "<h3>";
        calculate($numA,$numB,$operator);
        echo "</h3>";
        }
    }

 }
?>



</body>
</html>