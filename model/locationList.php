<?php
session_start();
include_once "../config.php";

if(isset($_GET['r'])) {
  $r = $_GET['r'];
  $stmt = $link->prepare("SELECT * FROM location WHERE locationName LIKE ?");
  $param = "%$r%";
  $stmt->bind_param("s", $param);
  $data = array();
  if($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $id = $row['locationID'];
        $locationName = $row['locationName'];
        $data[] = array('id' => $id, 'text' => $locationName);
      }
      $stmt->close();
    } else{
      $data[] = array('id' => 0, 'text' => 'No Location Found');
    }
    echo json_encode($data);
  }
}
