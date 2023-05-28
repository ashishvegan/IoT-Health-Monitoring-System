<?php
session_start();
if(!isset($_SESSION['loginid']))
{
	header("location:index.php?al=".sha1('session'));
}
require("../config.php");
if(!empty($_GET))
{
	$_SESSION['patient'] = $_GET['al'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>GRAPH</title>
  <link type="text/css" href="../style.css" rel="stylesheet"> 
</head>
<body>
<div align="center"><br>
<br>
<br>

  <div id="chart-container">GRAPH</div>
  <script src="js/jquery-2.1.4.js"></script>
  <script src="js/fusioncharts.js"></script>
  <script src="js/fusioncharts.charts.js"></script>
  <script src="js/themes/fusioncharts.theme.zune.js"></script>
  <script src="js/app.js"></script>
  <br>
<br>
<input type="button" value="HOME" onClick="window.location='../home.php'">
<br>
<br>
 </div>
</body>
</html>
