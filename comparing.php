<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="style.css">	

	<title>Comparing</title>
</head>
<body>
<a href="activities.php">Back</a>
<h1>Number Comparing</h1>
<form action="" method="GET">
<table border="1" align="center">
	<tr>
		<td>
			<input type="text" id="num1" name="num1" placeholder="Input Number 1" >
		</td>
		<td>
			<input type="text" id="num2" name="num2" placeholder="Input Number 2" >
		</td>
		<td>
			<input type="text" id="num3" name="num3" placeholder="Input Number 3" >
		</td>
		<td>
			<button type="submit" name="submit">Compare</button>
		</td>
	</tr>
</table>
</form>

<?php
if (isset($_GET['submit'])) {
	if (is_numeric($_GET['num1'])) {
		$n1=$_GET['num1'];
		}
	 
	if (is_numeric($_GET['num2'])) {
		$n2=$_GET['num2'];
		}

	if (is_numeric($_GET['num3'])) {
			$n3=$_GET['num3'];
		}	
	$result="";


	if ($n1 > $n2) {
		$result = $n1;
	} else {
		$result = $n2;
	}
	
	if ($result < $n3) {
		$result = $n3;
	}
	
	

	echo "<center> <h3>The largest number is $result </h3></center";
	}	
		
	
?>

</body>
</html>