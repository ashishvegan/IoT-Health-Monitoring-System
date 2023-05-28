<?php
session_start();
if(isset($_SESSION['loginid']))
{
	header("location:home.php?al=".sha1('already'));
}
require("config.php");
if(!empty($_POST))
{
	$v = mysqli_query($al, "SELECT * FROM hms_doctors WHERE loginid = '".mysqli_real_escape_string($al,$_POST['loginid'])."' AND password = '".mysqli_real_escape_string($al,sha1($_POST['password']))."'");
	if(mysqli_num_rows($v) == 1)
	{
		$_SESSION['loginid'] = $_POST['loginid'];
		header("location:home.php?al=".sha1('welcome'));
	}
	else
	{
		$msg = "Incorrect Login Details";
	}
}
if($_GET['al'] == sha1('signout'))
{
	$msg = "Successfully Signed Out";
}
if($_GET['al'] == sha1('session'))
{
	$msg = "Session Time Out Please Login Again";
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>IoT BASED PATIENT HEALTH MONITORING SYSTEM</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>

<body>
<div align="center">
<br>

<span class="head">IoT BASED PATIENT HEALTH MONITORING SYSTEM</span>
<br>
<br><br>
<br>

<div id="box">
<span class="subHead">Doctor Login</span>
<br>
<form method="post" action="">
<?php if(isset($msg)) { ?><span class="msg splash"><?php echo $msg;?></span><?php } ?><br>
<br>

<input type="text" name="loginid" required placeholder="Enter Login ID" title="Enter Login ID" />
<br>
<br>
<input type="password" name="password" required placeholder="Enter Password" title="Enter Password" />
<br>
<br>
<input type="submit" value="Sign in" />
</form>
</div>
</div>
</body>
</html>