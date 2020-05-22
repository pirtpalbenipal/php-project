<?php
$name_error="";
$email_error="";
$gender_error="";
$web_error="";

if(isset($_POST['Submit']))
{   
	
	
 $name_pattern;
$email_pattern;
$web_pattern;

	if(empty($_POST['Name'])){
		$name_error="Name is required";
	}
	else
	{
     $Name=test_user_input($_POST['Name']);
     $name_pattern=preg_match("/^[A-Za-z\. ]*$/", $Name);
     if(!$name_pattern)
     {
     	$name_error="only letters and whitepaces are allowed";
     }
	}

	

	if(empty($_POST['Email'])){
		$email_error="Email is required";
	}
	else
	{
     $Email=test_user_input($_POST['Email']);
     $email_pattern=preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/", $Email);
     if (!$email_pattern) {
        $email_error="invalid email format";
     }
	}

	if(empty($_POST['Gender'])){
		$gender_error="Gender is required";
	}
	else
	{
     $Gender=test_user_input($_POST['Gender']);
    
	}

	if(empty($_POST['Website'])){
		$web_error="Website is required";
	}
	else
	{
     $Website=test_user_input($_POST['Website']);
      $web_pattern=preg_match("/(https:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[a-zA-Z0-9.\-_\/?\$=&\#\~`!]*/", $Website);
     if(!$web_pattern)
     {
     	$web_error="invalid format";
     }
	}

	if(!empty($_POST["Name"])&&!empty($_POST["Email"])&&!empty($_POST["Gender"])&&!empty($_POST["Website"]))
	{
		if($name_pattern && $email_pattern && $web_pattern)
		{
			echo "<h2>Your Submit Information</h2> <br>";
echo "Name:".ucwords ($_POST["Name"])."<br>";
echo "Email: {$_POST["Email"]}<br>";
echo "Gender: {$_POST["Gender"]}<br>";
echo "Website: {$_POST["Website"]}<br>";
echo "Comments: {$_POST["Comment"]}<br>";
		}
	}




}

function test_user_input($data)
	{
		return $data;
	}


?>











<!DOCTYPE html>
<html>
<head>
	<title>Form Validation Project</title>
</head>
<style>
	input[type="text"],input[type="email"],textarea{
	border:  2px solid black;
	background-color: rgb(125,196,182);
	width: 400px;
	padding: .5em;
	font-size: 1.0em;
	border-radius: 20px;
	

}
.radio{
	font-size: 2em;
	
}
fieldset{
}
</style>
<body>
<form action="form_validation_project.php" method="post">
	<legend>Fill out your details</legend>
	<fieldset>
	<span style="font-size:2em;">	Name:<br></span>
        <input class="input" type="text" name="Name" value="">
        <span style="color:red">*<?php echo $name_error; ?><br></span>

       <span style="font-size: 2em;"> E-mail:<br></span>
        <input class ="input" type="text" name="Email" value="">
        <span style="color:red">*<?php echo $email_error; ?><br></span>

      <span style="font-size: 2em;">  Gender:<br></span>
        <input class="radio" type="radio" name="Gender" value="Female"><span style="font-size: 2em;">female<br></span>
        
        <input class="radio" type="radio" name="Gender" value="Male"> <span style="font-size: 2em;">male<br></span>
       
       <span style="color: red"> *<?php echo $gender_error; ?><br></span>

       <span style="font-size: 2em;"> Website:<br></span>
        <input class="input" type="text" name="Website" value="">
        <span style="color: red;">*<?php echo $web_error; ?><br></span>

      <span style="font-size: 2em;"> Comment:<br></span>
        <textarea name="Comment" rows="5" cols="25"></textarea>
        <br>
        <br>
        <input type="Submit" name="Submit" value="Submit ">
	</fieldset>
</form>
</body>
</html>