<?php
require_once("include/db.php");
if(isset($_POST['submit']))
{
	if(!empty($_POST['ename']) && !empty($_POST['ssn']))
	{
       $ename=$_POST['ename'];
       $ssn=$_POST['ssn'];
       $dept=$_POST['dept'];
       $salary=$_POST['salary'];
       $homeaddress=$_POST['homeaddress'];
       global $connect;
       //sql injection u sing pdo dummy variables
       $sql="INSERT INTO employee_record (ename,ssn,dept,salary,homeaddress) 
       VALUES(:enamE,:ssN,:depT,:salarY,:homeaddresS)";
       $stmt=$connect->prepare($sql);
       $stmt->bindValue(':enamE',$ename);
       $stmt->bindValue(':ssN',$ssn);
       $stmt->bindValue(':depT',$dept);
       $stmt->bindValue(':salarY',$salary);
       $stmt->bindValue(':homeaddresS',$homeaddress);
       $execute=$stmt->execute();
       if($execute)
       {
       	echo "Record added successfully<br>";
       }
       else
       {
       	echo "<h1>very sorry unsuccessfull</h1>";
       }

	}
	else
	{
		echo '<span class="fieldinfoheading">Please enter your name and Social Security Number</span><br>';
	}
}


?>












<!DOCTYPE html>
<html>
<head>
	<title>Insert into Database</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
</head>
<body>
	<div>
		<form action="db_connection.php" method="post">
			<fieldset>

				<span class="fieldinfo"> Employee Name:</span><br>
				<input type="text" name="ename" value=""><br>

				<span class="fieldinfo"> Social Security No:</span><br>
				<input type="text" name="ssn" value=""><br>

				<span class="fieldinfo"> Department</span><br>
				<input type="text" name="dept" value=""><br>

				<span class="fieldinfo"> Salary:</span><br>
				<input type="text" name="salary" value=""><br>

				<span class="fieldinfo"> Home Address</span><br>
                 <textarea  rows="12" cols="80" name="homeaddress"></textarea><br>
				<input type="submit" name="submit" value="Submit your record"><br>
			</fieldset>
		</form>
	</div>

</body>
</html>