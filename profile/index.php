<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: ../login.php");
  exit;
}
require_once "../config.php";

$accID =  $_SESSION["accountID"];
$sql = "SELECT taskHandler.taskHandlerID AS tID,
        CONCAT(taskHandler.taskHandlerFName, ' ' , taskHandler.taskHandlerLName) AS tName
        FROM taskHandler
        LEFT JOIN account ON taskHandler.accountID = account.accountID
        WHERE account.accountID = $accID";
$result = mysqli_query($link, $sql);
//if ($result->num_rows > 0) {
// output data of each row
$i = 0;
while ($row = mysqli_fetch_array($result)) {
  $tID = $row["tID"];
  $tName = $row["tName"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard &mdash; EmployMe.bz</title>

  <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
  <link rel="manifest" href="../images/site.webmanifest">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

  <link rel="stylesheet" media="all" href="../css/style.css" />


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
            <li class="nav-item active">
              <a class="nav-link" href="../profile/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tasks/">Tasks</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="applications/">Applications</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../logout.php">Logout</a>
            </li>

            <li class="nav-item">
              <a class="nav-link disabled" href="#">&nbsp;</a>
            </li>
          </ul>
          
          <select type="number" id="locationSelect" name="location" class="locationSelect form-control">
                      <option value=""></option>
                    </select>
            <button class="btn btn-outline-success my-2 my-sm-0" onclick="search(<?php echo $tID ?>)">Search</button>
          
        </div>
      </nav>

      <!-- nav end -->

      <div class="container">

      <div class="row row-content d-flex justify-content-center mt-3 ">
      <div id="card-container" class = "card-group"></div>
      </div>
      <!--tasks table-->
      <div class="row row-content d-flex justify-content-center mt-3">
      
          <br>
          <h3 class="d-block">Open Tasks</h3>

          <div class="col-md-12 table-responsive table-sm">
            <br>
            <table id="openTasksTable" class="table text-left table-striped">
              <thead class="thead-dark">
                <tr class="table-header">

                <th>Date Begin</th>
                  <th>Task ID</th>
                  <th>Employer</th>
                  <th>Task Name</th>                
                  <th>Status</th>
                  <th>Location</th>
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
                $sql = "SELECT tasks.taskID AS tID,
                tasks.taskName AS tName,
                DATE_FORMAT(tasks.taskDateBegin, '%d %M %Y') AS tDate,
                tasks.taskStatus AS tStat,
                location.locationName AS tLocation,
                CONCAT(employer.employerFName, ' ' , employer.employerLName) AS eName
                FROM tasks
                LEFT JOIN location ON tasks.locationID = location.locationID
                LEFT JOIN employer ON tasks.employerID = employer.employerID
                LEFT JOIN application ON tasks.taskID = application.taskID
                WHERE tasks.taskStatus = 'Open'
                AND (tasks.taskID NOT IN(SELECT application.taskID FROM application WHERE taskHandlerID = $tID AND applicationStatus = 'Active'))
                ORDER BY DATE_FORMAT(tasks.taskDateBegin, '%d %M %Y') DESC
                ;";
                $result = mysqli_query($link, $sql);
                //if ($result->num_rows > 0) {
                // output data of each row
                $i = 0;
                while ($row = mysqli_fetch_array($result)) {
                  $i++;
                  $taskID = $row["tID"];
                ?>
                  <tr>
                  <td> <?php echo $row["tDate"] ?></td>
                    <td> <?php echo "T-" . $row["tID"] ?></td>
                    <td> <?php echo $row["eName"] ?></td>
                    <td> <?php echo $row["tName"] ?></td>                   
                    <td class = "<?php echo strtolower($row["tStat"]) ?>"> <?php echo $row["tStat"] ?></td>
                    <td> <?php echo $row["tLocation"] ?></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn dropdown-toggle text-center green" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu">
                        <button class="dropdown-item" data-id="<?php echo $row["tID"]; ?>" >View Details</button>
                          <div class="dropdown-divider"></div>
                          <button class="dropdown-item" onclick="apply(<?php echo $taskID ?>,<?php echo $tID ?>)" >Apply</button>

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
      </div>

      <footer class="footer-section text-center">
        <div class="container">
          <p>Copyright &copy; 2020 &middot; All Rights Reserved &middot; <a href="#">EmployME.bz</a></p>
        </div>
      </footer>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <script src="../controller/search.js"></script>
      
</body>

</html>