<?php
session_start();
include_once "../config.php";


$action = mysqli_real_escape_string($link, $_POST["action"]);
$data = [];

if ($action == "search") {
  if (isset($_POST["location"])) {
    $tID = mysqli_real_escape_string($link, $_POST["tHandler"]);
    $locationID = mysqli_real_escape_string($link, $_POST["location"]);

    $data["results"] = search($link,$tID, $locationID);
    $data["success"] = true;
  } else {
    $data["success"] = false;
  }
}

function search($link, $empID, $location)
{

  $stmt = $link->prepare("SELECT tasks.taskID AS tID, tasks.employerID AS eID, tasks.taskTypeID AS ttID, tasks.taskName as tName,
  tasks.taskDescription AS tDesc, tasks.taskDateBegin AS tDBegin, tasks.locationID as lID,
  CONCAT(employer.employerFName,' ', employer.employerLName) as eName, taskType.taskTypeName as ttName, location.locationName as lName
  FROM tasks
  LEFT JOIN taskType ON tasks.taskTypeID = taskType.taskTypeID
  LEFT JOIN employer ON tasks.employerID = employer.employerID
  LEFT JOIN location ON tasks.locationID = location.locationID
  WHERE tasks.locationID='$location' AND tasks.taskStatus='Open';");
  $jobList = array();
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $skills = $row["ttID"];
        $stmt1 = $link->prepare("SELECT * FROM taskHandlerSkills WHERE taskHandlerID = '$empID';");
        if ($stmt1->execute()) {
          $result1 = $stmt1->get_result();
          while ($row1 = $result1->fetch_assoc()) {
            if ($skills == $row1["taskTypeID"]) {
              $id = $row["tID"];
              $typeName = $row["tName"];
              $employerID = $row["eID"];
              $employerName = $row["eName"];
              $taskTypeID = $row["ttID"];
              $taskName = $row["tName"];
              $taskDescription = $row["tDesc"];
              $dateBegin = $row["tDBegin"];
              $success = true;
              //$ttID=$empID;
              $jobList[] = array('thID'=> $empID ,'success'=> true, 'id' => $id, 'text' => $typeName, 'emid' => $employerID, 'ename' => $employerName, 'tasktype' => $taskTypeID, 'taskName' => $taskName, 'desc' => $taskDescription, 'datebegin' => $dateBegin);
            }
          }
        }
      }
    } else {
      echo "No task available";
    }
    $myJSON = json_encode($jobList);
    echo $myJSON;
  } else {
    $data["message"] = mysqli_error($link);
  }
}
