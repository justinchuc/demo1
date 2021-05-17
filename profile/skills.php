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
if (isset($_POST['save'])) {
  $checkbox = $_POST['skill'];
  for ($i = 0; $i < count($checkbox); $i++) {
    $check_id = $checkbox[$i];
    $sql = "INSERT taskHandlerID=$accID, taskSkillsStatus=1,taskTypeID=$check_id INTO taskHandlerSkills";
    if (mysqli_multi_query($link, $sql)) {

      header("location: employer/");
    }
  }
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
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

      <!-- nav end -->


      <div class="container mt-3">
        <h3>Choose your Strongest Skills</h3>


        <form action="">
          <?php
          // Check connection
          if ($link->connect_error) {
            die("Connection failed: " . $link->connect_error);
          }
          $sql = "SELECT * FROM taskType
          ORDER BY taskTypeName ASC
                ;";
          $result = mysqli_query($link, $sql);
          //if ($result->num_rows > 0) {
          // output data of each row
          $i = 0;
          while ($row = mysqli_fetch_array($result)) {
            $i++;
            $value = $row["taskTypeID"];
            $taskName = $row["taskTypeName"];
          ?>
            <input type="checkbox" id="<?php echo "skill" . $i ?>" name="skill[]" value="<?php echo $value; ?>">
            <label for="<?php echo "skill" . $i ?>"> <?php echo $taskName; ?></label><br>


          <?php    }
          //} else {
          //echo "0 results";

          //  $link->close();
          ?>
          <br>
          <input type="submit" name="save" value="Submit">
        </form>




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
  <script src="../controller/tasks.js"></script>

</body>

</html>