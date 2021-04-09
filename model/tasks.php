<?php 
session_start();
include_once "../config.php";


  
$action = mysqli_real_escape_string($link, $_POST["action"]);

if($action == "newtask"){
  createTask(
    $link, 
    mysqli_real_escape_string($link, $_POST["name"]), 
    mysqli_real_escape_string($link, $_POST["desc"]), 
    mysqli_real_escape_string($link, $_POST["type"]), 
    mysqli_real_escape_string($link, $_POST["begin"]), 
    mysqli_real_escape_string($link, $_POST["end"]),
    mysqli_real_escape_string($link, $_POST["min"]), 
    mysqli_real_escape_string($link, $_POST["max"]), 
    mysqli_real_escape_string($link, $_POST["location"]), 
    mysqli_real_escape_string($link, $_POST["eID"])
  
  );
}

function createTask($link, $name, $desc, $type, $begin, $end, $min, $max, $location, $eID){

    $data["state"] = "success";
    $sql = "INSERT INTO tasks (employerID, taskTypeID, taskName, taskDescription, taskDateBegin, taskDateEnd, taskPriceSRange, taskPriceERange, locationID) 
    VALUES ('$eID', '$type', '$name', '$desc', '$begin', '$end', '$min', '$max', '$location');";
    if (mysqli_query($link, $sql)) {
      $data["state"] = "success";
      $data["message"] = "Your task has been added";
    } else {
      $data["state"] = "error";
      $data["message"] = "An error occurred while trying to add your tasks";
    }
    echo json_encode($data);
}