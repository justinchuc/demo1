<?php 
session_start();
include_once "../config.php";
  

$action = mysqli_real_escape_string($link, $_POST["action"]);

if($action == "apply"){
  apply($link, mysqli_real_escape_string($link, $_POST["taskID"]), mysqli_real_escape_string($link, $_POST["tID"]));
}



function apply($link, $taskID,$tID){
    $data["state"] = "success";
    $sql = "INSERT INTO application (taskID, taskHandlerID) VALUES('$taskID','$tID');";
    if(mysqli_query($link, $sql)){
      $data["state"] = "success";
      $data["message"] = "Your Application was successfull";
    } else {
      $data["state"] = "error";
      $data["message"] = "An error occurred while trying to apply for the task";
    }
    echo json_encode($data);
}