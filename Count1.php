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
        Start Number:<input type="text" name="numStart">
		End Number:<input type="text" name="numEnd">
        <input type="submit" name="submit" value="count">
        <br>
        </form>
    <?php
	if (isset($_GET['submit'])) {
        if(is_numeric($_GET['numStart'])){
        $numStart = $_GET['numStart'];
        if(is_numeric($_GET['numEnd'])){
        $numEnd = $_GET['numEnd'];
        
    if ($numStart <$numEnd){
        for ($i=$numStart; $i <= $numEnd; $i++) { 
            echo "Im'Ready!!! $i<br>";
        }
   }elseif($numStart > $numEnd){
            for ($i=$numStart; $i >= $numEnd; $i--){
                echo "Im'Ready!!! $i<br>";
            }
            }else{
            for ($i=$numStart; $i == $numEnd; $i++) { 
                echo "Start and End Number is
                the Same";
            }
        }
    }}
}
	?>
    


</body>
</html>