<?php
session_start();
if (!isset($_SESSION['loginid'])) {
	header("location:index.php?al=" . sha1('session'));
}
require("config.php");
$v = mysqli_fetch_array(mysqli_query($al, "SELECT * FROM hms_doctors WHERE loginid = '" . $_SESSION['loginid'] . "'"));
if (!empty($_GET)) {
	$ve = mysqli_query($al, "SELECT * FROM hms_data WHERE userid = '" . $_GET['al'] . "'");
	$vv = mysqli_fetch_array($ve);
	$_SESSION['al'] = $_GET['al'];
}
if ($_GET['key'] == sha1('success')) {
	$msg = "Successfully Deleted";
}
$veve = mysqli_query($al, "SELECT * FROM hms_data WHERE userid = '" . $_GET['al'] . "' ORDER BY id DESC");
$yy = mysqli_fetch_array($veve);
if ($yy['heartbeat'] >= 120) {
?>
	<audio controls autoplay loop hidden>
		<source src="beep.mp3" type="audio/mpeg">
	</audio>
<?php } elseif ($yy['temperature'] >= 105) {
?>
	<audio controls autoplay loop hidden>
		<source src="beep.mp3" type="audio/mpeg">
	</audio>
<?php } elseif ($yy['spo'] <= 94) {
?>
	<audio controls autoplay loop hidden>
		<source src="beep.mp3" type="audio/mpeg">
	</audio>
<?php } ?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="refresh" content="300; url=signout.php">
	<title>IoT BASED PATIENT HEALTH MONITORING SYSTEM</title>
	<link href="style.css" type="text/css" rel="stylesheet" />
	<style type="text/css">
		table,
		tr,
		td,
		th {
			border: 1px solid #16222A;
			padding: 10px;
			font-family: 'd';
			font-size: 14px;
			color: rgba(255, 255, 255, 1.00);
			border-collapse: collapse;
		}

		a:link,
		a:active,
		a:visited {
			text-decoration: none;
			font-family: 'a';
			font-size: 14px;
			color: rgba(255, 34, 38, 1.00);
		}

		a:hover {
			text-decoration: underline;
			font-family: 'a';
			font-size: 14px;
			color: rgba(255, 34, 38, 1.00);
		}
	</style>
	<script type="text/javascript" src="scripts/jquery-3.1.1.min.js"></script>
	<script>
		function ajaxCall() {
			$.ajax({
				url: "viewPatientScript.php",
				success: (function(result) {
					$("#vegan").html(result);
				})
			})
		};

		ajaxCall(); // To output when the page loads
		setInterval(ajaxCall, (1 * 1000)); // x * 1000 to get it in seconds
	</script>
</head>

<body>
	<div align="center">
		<br>

		<span class="head">IoT BASED PATIENT HEALTH MONITORING SYSTEM</span>
		<br>
		<br><br>
		<br>

		<div id="box">
			<span class="subHead">Patient Data</span>
			<br><br>
			<span class="msg" style="font-size:20px;">Patient ID : <?php echo $vv['userid']; ?></span>
			<br>
			<?php if (isset($msg)) { ?><span class="msg splash"><?php echo $msg; ?></span><?php } ?><br>

			<br>

			<div id="vegan"></div>
			<br>
			<br>
			<input type="button" onClick="window.location='home.php'" value="BACK">
			<input type="button" onClick="window.location='signout.php'" value="SIGN OUT">
			<br>
		</div>
	</div>
</body>

</html>