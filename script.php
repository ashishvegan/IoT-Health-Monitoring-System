<?php
require("config.php");
date_default_timezone_set("Asia/Kolkata");
if(!empty($_GET))
{
	$v = mysqli_query($al, "INSERT INTO hms_data(userid,heartbeat,temperature,spo,time,date) VALUES('DEVICE_1','".$_GET['p']."','".$_GET['t']."','".$_GET['s']."','".date('h:i:A')."','".date('d/m/Y')."')");
	if($v)
	{
		echo "Success";
	}
	else
	{
		echo "Error";
	}
}
?>