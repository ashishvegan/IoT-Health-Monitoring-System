<?php
session_start();
if(!isset($_SESSION['loginid']))
{
	header("location:index.php?al=".sha1('session'));
}
require("config.php");
$v = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM hms_doctors WHERE loginid = '".$_SESSION['loginid']."'"));
if($_GET['al'] == sha1('welcome'))
{
	$msg = "Welcome ".$v['name'];
}
if($_GET['al'] == sha1('already'))
{
	$msg = "You are already logged in";
}
if($_GET['key'] == sha1('success'))
{
	$msg = "Successfully Deleted";
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="300; url=signout.php">
<title>IoT BASED PATIENT HEALTH MONITORING SYSTEM</title>
<link href="style.css" type="text/css" rel="stylesheet" />
<style type="text/css">
table, tr, td, th
{
	border:1px solid #16222A;
	padding:10px;
	font-family:'d';
	font-size:16px;
	color:rgba(255,255,255,1.00);
	border-collapse:collapse;
}

a:link, a:active, a:visited
{
	text-decoration:none;
	font-family:'a';
	font-size:14px;
	color:rgba(255,34,38,1.00);
}

a:hover
{
	text-decoration:underline;
	font-family:'a';
	font-size:14px;
	color:rgba(255,34,38,1.00);
}
</style>
</head>

<body>
<div align="center">
<br>

<span class="head">IoT BASED PATIENT HEALTH MONITORING SYSTEM</span>
<br>
<br><br>
<br>

<div id="box">
<span class="subHead">Select Patient</span>
<br><br>

<?php if(isset($msg)) { ?><span class="msg splash"><?php echo $msg;?></span><?php } ?><br>
<br>
<br>

<table border="0">
<tr style="text-decoration:underline;"><th>NAME OF PATIENT</th>
<th>VIEW</th><th>DELETE</th></tr>
<?php
$x = mysqli_query($al, "SELECT DISTINCT userid FROM hms_data"); // acccesing variable userid from table "hms_data"
while($y = mysqli_fetch_array($x))
{
?>
<tr class="data"><td><?php echo $y['userid'];?></td>           
<td><a href="viewPatient.php?al=<?php echo $y['userid'];?>">VIEW</a></td>
<td><a href="deletePatient.php?al=<?php echo $y['userid'];?>" onClick="return confirm('Are You Sure..?');">DELETE</a></td></tr>
<?php
} // td table data
?>
</table>
<br>
<br>
<input type="button" onClick="window.location='signout.php'" value="SIGN OUT">
<br>
</div>
</div>
</body>
</html>