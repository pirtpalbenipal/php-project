<?php
require_once("include/db.php");
$search_query_parameter=$_GET["id"];
if(isset($_POST['submit']))
{    
	$ename=$_POST['ename'];
       $ssn=$_POST['ssn'];
       $dept=$_POST['dept'];
       $salary=$_POST['salary'];
       $homeaddress=$_POST['homeaddress'];
	
       
       global $connect;
       //sql injection u sing pdo dummy variables
       $sql="UPDATE employee_record SET ename='$ename',ssn='$ssn',dept='$dept',salary='$salary',homeaddress='$homeaddress' WHERE id='$search_query_parameter' ";
 
       $execute=$connect->query($sql);
      
       if($execute)
       {
       	echo "<script> window.open('viewdb.php?id=updated sucessfully','_self')</script>";
       }
     

	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update database</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
</head>
<body>

	<?php

		$sql="SELECT * FROM employee_record WHERE id=$search_query_parameter";
		$stmt=$connect->query($sql);
		while($array=$stmt->fetch())
		{
			$id=$array["id"];
			$ename=$array["ename"];
			$ssn=$array["ssn"];
			$dept=$array["dept"];
			$salary=$array["salary"];
			$homeaddress=$array["homeaddress"];
		}
			?>
	<div>
		<form action="update.php?id=<?php echo $search_query_parameter; ?>" method="post">
			<fieldset>

				<span class="fieldinfo"> Employee Name:</span><br>
				<input type="text" name="ename" value="<?php echo $ename;?>"><br>

				<span class="fieldinfo"> Social Security No:</span><br>
				<input type="text" name="ssn" value="<?php echo $ssn;?>"><br>

				<span class="fieldinfo"> Department</span><br>
				<input type="text" name="dept" value="<?php echo $dept;?>"><br>

				<span class="fieldinfo"> Salary:</span><br>
				<input type="text" name="salary" value="<?php echo $salary;?>"><br>

				<span class="fieldinfo"> Home Address</span><br>
                 <textarea  rows="12" cols="80" name="homeaddress"><?php echo $homeaddress;?>
                 	
                 </textarea><br>
				<input type="submit" name="submit" value="Submit your record"><br>
			</fieldset>
		</form>
	</div>

</body>
</html>