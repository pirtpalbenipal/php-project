<?php
require_once("include/db.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>view Database</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
</head>
<body>
	<div>
		<fieldset>
			<form action="viewdb.php" method="post">
				<input type="tex" name="search" placeholder="serch by name and ssn"><br>
				<input type="submit" name="seachbutton" value="Search">
			</form>
		</fieldset>
	</div>
	<?php
	if(isset($_POST["seachbutton"]))
	{  
		global $connect;
		$sql="SELECT *FROM employee_record WHERE ename=:searcH or ssn=:searcH";
		$stmt=$connect->prepare($sql);
		$stmt->bindValue(':searcH',$_POST['search']);
		$stmt->execute();
		while($array=$stmt->fetch())
		{
			$id=$array["id"];
			$ename=$array["ename"];
			$ssn=$array["ssn"];
			$dept=$array["dept"];
			$salary=$array["salary"];
			$homeaddress=$array["homeaddress"];
			?>

			<table width="1000" align="centre" border="5">
		<caption>Searched Result</caption>
		<tr>
			<th>id</th>
			<th>Employee name</th>
			<th>SSN</th>
			<th>Department</th>
			<th>Salary</th>
			<th>Home Address</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
		<tr>
			<td><?php echo $id;?></td>
			<td><?php echo $ename;?></td>
			<td><?php echo $ssn;?></td>
			<td><?php echo $dept;?></td>
			<td><?php echo $salary;?></td>
			<td><?php echo $homeaddress;?></td>
			<td>
				<a href="update.php?id=<?php echo  $id;?>" >update </a>
			</td>
			<td>
				<a href="delete.php?id=<?php echo $id;?>"> delete</a>
			</td>
			</tr>

		
	<?php 
	}//ending of while loop
    }
	?>
	<table width="1000" align="centre" border="5">
		<caption>EMPLOYEE DATABASE</caption>
		<tr>
			<th>id</th>
			<th>Employee name</th>
			<th>SSN</th>
			<th>Department</th>
			<th>Salary</th>
			<th>Home Address</th>
			<th>Update</th>
			<th>Delete</th>
		</tr>
		<?php

		$sql="SELECT * FROM employee_record";
		$stmt=$connect->query($sql);
		while($array=$stmt->fetch())
		{
			$id=$array["id"];
			$ename=$array["ename"];
			$ssn=$array["ssn"];
			$dept=$array["dept"];
			$salary=$array["salary"];
			$homeaddress=$array["homeaddress"];
			?>
			<tr>
			<td><?php echo $id;?></td>
			<td><?php echo $ename;?></td>
			<td><?php echo $ssn;?></td>
			<td><?php echo $dept;?></td>
			<td><?php echo $salary;?></td>
			<td><?php echo $homeaddress;?></td>
			<td>
				<a href="update.php?id=<?php echo  $id;?>" >update </a>
			</td>
			<td>
				<a href="delete.php?id=<?php echo $id;?>"> delete</a>
			</td>
			</tr>
		<?php }?>
		
	</table>
	<div>
		
	</div>

</body>
</html>