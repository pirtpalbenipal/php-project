<!DOCTYPE html>
<html>
<head>
	<title>file1</title>
</head>
<body>
	<?php $name="Pirtpal Singh"; $position="student at PEC";?>

	<a href="file2.php Name?=<?php echo $name; ?>&Position=<?php echo urlencode($position);?>">Click </a>

</body>
</html>