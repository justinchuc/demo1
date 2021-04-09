<?php
session_start();
include_once "../config.php";

if(isset($_GET['q'])) {
  $q = $_GET['q'];
  $stmt = $link->prepare("SELECT * FROM taskType WHERE taskTypeName LIKE ?");
  $param = "%$q%";
  $stmt->bind_param("s", $param);
  $data = array();
  if($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $id = $row['taskTypeID'];
        $typeName = $row['taskTypeName'];
        $data[] = array('id' => $id, 'text' => $typeName);
      }
      $stmt->close();
    } else{
      $data[] = array('id' => 0, 'text' => 'No Task Type Found');
    }
    echo json_encode($data);
  }
}
