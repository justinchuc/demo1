<?php

//Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


  // Prepare a select statement
  $sql = "SELECT accountID FROM account WHERE username = ?";

  if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_username);

    // Set parameters
    $param_username = trim($_POST["username"]);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
      /* store result */
      mysqli_stmt_store_result($stmt);

      if (mysqli_stmt_num_rows($stmt) == 1) {
        $username_err = "This username is already taken.";
      } else {
        $username = trim($_POST["username"]);
      }
    } else {
      echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
  }




  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";
  } elseif (strlen(trim($_POST["password"])) < 6) {
    $password_err = "Password must have atleast 6 characters.";
  } else {
    $password = trim($_POST["password"]);
  }

  // Validate confirm password
  if (empty(trim($_POST["confirm_password"]))) {
    $confirm_password_err = "Please confirm password.";
  } else {
    $confirm_password = trim($_POST["confirm_password"]);
    if (empty($password_err) && ($password != $confirm_password)) {
      $confirm_password_err = "Password did not match.";
    }
  }

  // Check input errors before inserting in database
  if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

    // Prepare an insert statement
    $sql = "INSERT INTO account (username, password, accountType, accountStatus) VALUES (?, ?, 1,1)";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

      // Set parameters
      $param_username = $username;
      $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash



      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt)) {
        $sql = "SELECT accountID FROM account WHERE username= $param_username ;";

        $fName=trim($_POST["fname"]);
        $lName=trim($_POST["lname"]);
        $email=trim($_POST["email"]);
        $address=trim($_POST["address"]);
        $location=trim($_POST["location"]);

        $result = mysqli_query($link, $sql);
        if ($result->num_rows = 1) {
          while ($row = mysqli_fetch_array($result)) {
           $accountID= $row["inv"];
            $sql = "INSERT INTO  taskHandler ( accountID, taskHandlerFName, taskHandlerLName, taskHandlerEmail, taskHandlerAddress, locationID)
    VALUES ('$accountID', '$fName', '$lName', '$email', '$address','1');";
    
           if(mysqli_query($link, $sql)){ 

            header("location: login.php");
            exit();
           }
          }
        }
        else{
          echo "Oops! Something went wrong!!!!!";
        }

        // Redirect to login page
       
      } else {
        echo "Something went wrong. Please try again later.";
      }




      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register &mdash; EmployMe.bz</title>

  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
  <link rel="manifest" href="images/site.webmanifest">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.css" integrity="sha512-p209YNS54RKxuGVBVhL+pZPTioVDcYPZPYYlKWS9qVvQwrlzxBxkR8/48SCP58ieEuBosYiPUS970ixAfI/w/A==" crossorigin="anonymous" />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  <link rel="stylesheet" media="all" href="css/style.css" />


</head>

<body>
  <div id="page-container">
    <div id="content-wrap">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">EmployMe.bz</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About <span class="sr-only"></span></a>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container">
        <div class="row row-content d-flex justify-content-center">
          <div class="col-md-6 text-center">

            <h4 class="mt-3">Register</h4>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control" id="firstName" name="fname" placeholder="First Name" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="lastName">Last Name</label>
                  <input type="text" class="form-control" id="lastName" name="lname"placeholder="Last Name" required>
                </div>
                <div class="col-md-4">
                  <label for="validationServerUsername">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend3">@</span>
                    </div>
                    <input type="text" class="form-control" id="validationServerUsername" placeholder="Username" name="username" aria-describedby="inputGroupPrepend3" required>
                    <span class="help-block"><?php echo $username_err; ?></span>

                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
              </div>
              <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name = "address" placeholder="1234 Main St" required>
              </div>

              <div class="form-group">
                <label for="inputCity">City/Town/Village</label>
                <input type="text" class="form-control" id="inputLocation" name="location" required>
              </div>

              <button type="submit" class="btn btn-primary">Register</button>
            </form>


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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.js" integrity="sha512-tvs4l2C3VPcCHzUU1KGG+jWWTO7H0stvk1jwn6pr4B1uimcL/2api3rnmkMhVQ6DglgxLcqyLSDS1IF5eyeTRg==" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
</body>



</html>