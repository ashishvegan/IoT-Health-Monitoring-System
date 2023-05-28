<?php
session_start();
require_once("../config.php");
$query = "SELECT * FROM hms_data WHERE userid = '".$_SESSION['patient']."' ORDER BY id desc limit 40";
$result = $conn->query($query);
$jsonArray = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $jsonArrayItem = array();
    $jsonArrayItem['label'] = $row['time'];
    $jsonArrayItem['value'] = $row['heartbeat'];
    array_push($jsonArray, $jsonArrayItem);
  }
}
$conn->close();
header('Content-type: application/json');
echo json_encode($jsonArray);
?>
