<?php
echo "Server Details-><br>";
	echo "SERVER_NAME-> ". $_SERVER['SERVER_NAME'] ."<br>";
	echo "SERVER_ADDR-> ". $_SERVER['SERVER_ADDR'] ."<br>";
	echo "SERVER_PORT-> ". $_SERVER['SERVER_PORT'] ."<br>";
	echo "DOCUMENT_ROOT-> ". $_SERVER['DOCUMENT_ROOT'] ."<br>";
	echo "<br>";

echo "page info<br>";
     echo "PHP_SELF-> ". $_SERVER['PHP_SELF'] ."<br>";
	 echo "SCRIPT_FILENAME-> ". $_SERVER['SCRIPT_FILENAME'] ."<br>";
	 echo "<br>";

echo "info of person who is sending request to our site<br>";
    echo "REMOTE_ADDR-> ". $_SERVER['REMOTE_ADDR'] ."<br>";
	echo "REMOTE_PORT-> ". $_SERVER['REMOTE_PORT'] ."<br>";
	echo "REQUEST_URI-> ". $_SERVER['REQUEST_URI'] ."<br>";
	echo "QUERY_STRING-> ". $_SERVER['QUERY_STRING'] ."<br>";
	echo "REQUEST_METHOD-> ". $_SERVER['REQUEST_METHOD'] ."<br>";
	echo "REQUEST_TIME-> ". $_SERVER['REQUEST_TIME'] ."<br>";
	echo "HTTP_REFERER-> ". $_SERVER['HTTP_REFERER'] ."<br>";
	echo "HTTP_USER_AGENT-> ". $_SERVER['HTTP_USER_AGENT'] ."<br>";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Server information</title>
</head>
<body>

</body>
</html>