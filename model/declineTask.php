<?php 
session_start();
include_once "../config.php";
  

$action = mysqli_real_escape_string($link, $_POST["action"]);

if($action == "decline"){
  decline($link, mysqli_real_escape_string($link, $_POST["taskID"]));
}

elseif($action == "complete"){

  complete($link, mysqli_real_escape_string($link, $_POST["taskID"]));
}



function decline($link, $taskID){
    $data["state"] = "success";
    $sql = "UPDATE tasks 
    SET taskStatus = 'Declined'
    WHERE taskID = $taskID;";
    if(mysqli_query($link, $sql)){
      $data["state"] = "success";
      $data["message"] = "Your update was succesfull";
    } else {
      $data["state"] = "error";
      $data["message"] = "An error occurred while trying to update the task.";
    }
    echo json_encode($data);
}


function complete($link, $taskID){
  $data["state"] = "success";
  $sql = "UPDATE tasks 
  SET taskStatus = 'Completed'
  WHERE taskID = $taskID;";
  if(mysqli_query($link, $sql)){
    $data["state"] = "success";
    $data["message"] = "Your update was succesfull";
  } else {
    $data["state"] = "error";
    $data["message"] = "An error occurred while trying to update the task.";
  }
  echo json_encode($data);
}