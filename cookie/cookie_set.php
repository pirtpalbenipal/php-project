<?php
$expiretime=time();//it gives current time in seconds
$name_of_cookie_file="Pirtpal";
$content="this contain content of our cookie file";
$timetolive=$expiretime+8400;
setcookie($name_of_cookie_file,$content,$timetolive);
echo "content of cookie file is :".$_COOKIE["Pirtpal"];
// now how to unset your cookie ,many ways are there
//1. setting negative time
$expiretime_unset=time()-84000;
setcookie("Pirtpal",$content,$expiretime_unset);
//2. by seeting content to null
setcookie("Pirtpal",null);
if(isset($_COOKIE['Pirtpal']))
{
	echo "cookie is set<br>";
}
else
{
	echo "Cookie is unset<br>";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Setting Cookie</title>
</head>
<body>
Always add cookie file at the top
</body>
</html>