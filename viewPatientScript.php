<?php
session_start();
if(!isset($_SESSION['loginid']))
{
	header("location:index.php?al=".sha1('session'));
}
require("config.php");
?>
<table border="0">
<tr style="text-decoration:underline;">
<th>Sr. No.</th>
<th>HEARTBEAT <br><a href="graph_hb/index.php?al=<?php echo $_SESSION['al'];?>" style="color:rgba(174,197,4,1.00);font-size:12px;">[Click For Graph]</a></th>
<th>TEMPERATURE <br><a href="graph/index.php?al=<?php echo $_SESSION['al'];?>" style="color:rgba(174,197,4,1.00);font-size:12px;">[Click For Graph]</a></th>
<th>SPO2<br><a href="graph_sp/index.php?al=<?php echo $_SESSION['al'];?>" style="color:rgba(174,197,4,1.00);font-size:12px;">[Click For Graph]</a></th>
<th>TIME</th>
<th>DATE</th>
<th>DELETE</th>
</tr>
<?php
$sr=1;
$ve = mysqli_query($al, "SELECT * FROM hms_data WHERE userid = '".$_SESSION['al']."' ORDER BY id DESC");
while($y = mysqli_fetch_array($ve))
{
	?>
<tr>
<td><?php echo $sr++;?></td>
<td><?php echo $y['heartbeat'];?></td>
<td><?php echo $y['temperature'];?></td>
<td><?php echo $y['spo'];?></td>
<td><?php echo $y['time'];?></td>
<td><?php echo $y['date'];?></td>
<td><a href="deletePatientRecord.php?al=<?php echo $y['id'];?>&userid=<?php echo $_SESSION['al'] ;?>">DELETE</a></td></tr>
<?php
}//echo mysqli_error($al);
?>
</table>
