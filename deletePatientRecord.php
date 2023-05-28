<?php
session_start();
if(!isset($_SESSION['loginid']))
{
	header("location:index.php?al=".sha1('session'));
}
require("config.php");
mysqli_query($al, "DELETE FROM hms_data WHERE id = '".$_GET['al']."'");
header("location:viewPatient.php?key=".sha1('success')."&al=".$_GET['userid']);
?>