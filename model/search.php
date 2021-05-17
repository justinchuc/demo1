<?php
session_start();
include_once "../config.php";


$action = mysqli_real_escape_string($link, $_POST["action"]);
$data = [];

if ($action == "search") {
  if (isset($_POST["location"])) {
    $tID = mysqli_real_escape_string($link, $_POST["tHandler"]);
    $locationID = mysqli_real_escape_string($link, $_POST["location"]);

    $data["results"] = search($link, $link, $tID, $locationID);
    $data["success"] = true;
  } else {
    $data["success"] = false;
  }
}

function search($link, $empID, $location)
{

  $stmt = $link->prepare("SELECT * FROM tasks WHERE locationID='$location' AND taskStatus='Open';");
  $jobList = array();
  if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $skills = $row["taskTypeID"];
        $stmt1 = $link->prepare("SELECT * FROM taskHandlerSkills WHERE taskHandlerID = '$empID';");
        if ($stmt1->execute()) {
          $result1 = $stmt1->get_result();
          while ($row1 = $result1->fetch_assoc()) {
            if ($skills == $row1["taskTypeID"]) {
              $id = $row["taskTypeID"];
              $typeName = $row["taskTypeName"];
              $employerID = $row["employerID"];
              $taskTypeID = $row["taskTypeID"];
              $taskName = $row["taskName"];
              $taskDescription = $row["taskDescription"];
              $dateBegin = $row["taskDateBegin"];
              $dateEnd = $row["taskDateEnd"];
              $sRange = $row["taskPriceSRange"];
              $eRange = $row["taskPriceERange"];
              $jobList[] = array('id' => $id, 'text' => $typeName, 'emid' => $employerID, 'tasktype' => $taskTypeID, 'taskName' => $taskName, 'description' => $taskDescription, 'datebegin' => $dateBegin, 'dateend' => $dateEnd, 'startRange' => $sRange, 'endRange' => $dateEnd);
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
