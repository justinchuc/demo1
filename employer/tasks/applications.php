<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../../login.php");
  exit;
}
require_once "../../config.php";

$accID =  $_SESSION["accountID"];
$sql = "SELECT employer.employerID AS eID
        FROM employer
        LEFT JOIN account ON employer.accountID = account.accountID
        WHERE account.accountID = $accID";
$result = mysqli_query($link, $sql);
//if ($result->num_rows > 0) {
// output data of each row
$i = 0;
while ($row = mysqli_fetch_array($result)) {
  $empID = $row["eID"];

  $taskID = $_GET['GetID'];

}

$sql2 = "SELECT taskTypeID, taskName, taskDescription, taskDateBegin, taskDateEnd, taskPriceERange, taskStatus, locationID
FROM tasks
WHERE taskID = $taskID; ";
$result = mysqli_query($link, $sql2);
//if ($result->num_rows > 0) {
// output data of each row
$i = 0;
while ($row = mysqli_fetch_array($result)) {
  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tasks &mdash; EmployMe.bz </title>

 <!--favicon-->
  <link rel="apple-touch-icon" sizes="180x180" href="../../images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../../images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../../images/favicon-16x16.png">
  <link rel="manifest" href="../../images/site.webmanifest">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

  <link rel="stylesheet" media="all" href="../../css/style.css" />

</head>

<body>
  <div id="page-container">
    <div id="content-wrap">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">EmployMe.bz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="../../employer/">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="../tasks/">Tasks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../logout.php">Logout</a>
            </li>

            <li class="nav-item">
              <a class="nav-link disabled" href="#">&nbsp;</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>
      <!--nav end -->

      <div class="container"> <br>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary" data-toggle="modal" data-target="#createTask">Create Task</button>
          </div>
          <div class="alert_window">
            <div id="createtask_success" class="alert alert-success show" role="alert">
            </div>
            <div id="createtask_failure" class="alert alert-danger show" role="alert">
            </div>
          </div>
        </div>
        <!--tasks table-->
        <div class="row row-content d-flex justify-content-center">
          <br>
          <h3 class="d-block">Applications</h3>

          <div class="col-md-12 table-responsive table-sm">
            <br>
            <table id="openTasksTable" class="table text-left table-striped">
              <thead>
                <tr class="table-header">
                 <th>Task ID</th>
                  <th>Date</th>
                  <th>Applicant Name</th>
                  <th>Application Status</th>
                  <th>Action</th>

                </tr>
              </thead>
              <tbody>
                <!-- appointment body starts here -->
                <?php
                // Check connection
                if ($link->connect_error) {
                  die("Connection failed: " . $link->connect_error);
                }
                $sql = "SELECT application.taskID AS tID,
                application.applicationTime AS aTime,
                application.taskHandlerID AS tHID,
                CONCAT(taskHandler.taskHandlerFName, ' ', taskHandler.taskHandlerLName) AS tHName,
                application.applicationStatus AS aStatus
                FROM application
                LEFT JOIN taskHandler ON application.taskHandlerID = taskHandler.taskHandlerID
                WHERE application.taskID = $taskID;";
                $result = mysqli_query($link, $sql);
                //if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                  $i++;
                ?>
                  <tr>
                    <td> <?php echo "T-".$row["tID"] ?></td>
                    <td> <?php echo $row["aTime"] ?></td>
                    <td> <?php echo $row["tHName"] ?></td>
                    <td> <?php echo $row["aStatus"] ?></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn dropdown-toggle text-center green" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <button class="dropdown-item" type="button">Assign</button>
                          <div class="dropdown-divider"></div>
                          <button class="dropdown-item" type="button">Deny</button>

                          <button class="dropdown-item" type="button">Another Action</button>
                        </div>
                      </div>
                    </td>

                  </tr>
                <?php    }
                //} else {
                //echo "0 results";

                //  $link->close();
                ?>
              </tbody>
            </table>



          </div>

        </div>
        <!-- Create Task Modal -->
        <div class="modal fade" id="createTask" tabindex="-1" role="dialog" aria-labelledby="createTaskLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="createTaskLabel">Create Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="" name="createTask" onsubmit="createT()" method="post">

                  <div>
                    <label class="ml-3">Task Name</label>
                    <input type="text" id="createtname" name="create_tname" class="form-control" required>
                    <span id="errorTName" class="help-block text-danger"></span>
                  </div>
                  <div>
                    <label class="ml-3">Task Description</label>
                    <input type="text" id="createtdesc" name="create_tdesc" class="form-control" required>
                    <span id="errorTDesc" class="help-block text-danger"></span>
                  </div>
                  <div>
                    <label class="ml-3">Task Type</label>
                    <select id="createttype" name="create_ttype" class="typeSelect form-control" required>
                      <option value=""></option>
                    </select>
                    <span id="errorTType" class="help-block text-danger"></span>
                  </div>
                  <div class="form-row mt-2">
                    <div class="form-group col-md-6">
                      <label class="ml-3">Min Price</label>
                      <input type="number" id="createminprice" name="create_minprice" class="form-control" required>
                      <span id="errorMinPrice" class="help-block text-danger"></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="ml-3">Max Price</label>
                      <input type="number" id="createmaxprice" name="create_maxprice" class="form-control" required>
                      <span id="errorMaxPrice" class="help-block text-danger"></span>
                    </div>
                  </div>
                  <div class="form-row mt-2">
                    <div class="form-group col-md-6">
                      <label class="ml-3">Date Begin</label>
                      <input type="date" id="createdatebegin" name="createdatebegin" class="form-control" required>
                      <span id="errorDateBegin" class="help-block text-danger"></span>
                    </div>
                    <div class="form-group col-md-6">
                      <label class="ml-3">Date End</label>
                      <input type="date" id="createdateend" name="createdateend" class="form-control" required>
                      <span id="errorDateEnd" class="help-block text-danger"></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="ml-3">Location</label>
                    <select type="number" id="createtlocation" name="create_tlocation" class="locationSelect form-control">
                      <option value=""></option>
                    </select>
                    <span id="errorLocation" class="help-block text-danger"></span>
                  </div>
                  <div class="form-group text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <input type="hidden" name="action" value="createTask">
                  <input id="eID" type="hidden" name="action" value="<?php echo $empID ?>">
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- modal end -->

      </div>
      <footer class="footer-section text-center">
        <div class="container">
          <p>Copyright &copy; 2020 &middot; All Rights Reserved &middot; <a href="#">EmployME.bz</a></p>
        </div>
    </div>

  </div>
  </div>


  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

  <script src="../../controller/tasks.js"></script>

</body>

</html>