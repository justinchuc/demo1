<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
  //header("location: welcome.php");
  switch ($_SESSION["accountType"])
  {
    case 1:
      header("location: employer/");
      exit();
      break;
    case 2:
      header("location: profile/");
      exit();
      break;
  }
  exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

  // Check if username is empty
  if (empty(trim($_POST["username"])))
  {
    $username_err = "Please enter username.";
  }
  else
  {
    $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if (empty(trim($_POST["password"])))
  {
    $password_err = "Please enter your password.";
  }
  else
  {
    $password = trim($_POST["password"]);
  }

  // Validate credentials
  if (empty($username_err) && empty($password_err))
  {
    // Prepare a select statement
    $sql = "SELECT account.accountID, account.username, account.password , account.accountType FROM account WHERE account.username = ?";

    if ($stmt = mysqli_prepare($link, $sql))
    {
      // Bind variables to the prepared statement as parameters
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set parameters
      $param_username = $username;

      // Attempt to execute the prepared statement
      if (mysqli_stmt_execute($stmt))
      {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($stmt) == 1)
        {
          // Bind result variables
          $stmt->bind_result($id, $username, $hashed_password, $account);
          if (mysqli_stmt_fetch($stmt))
          {
            if (password_verify($password, $hashed_password))
            {
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["accountID"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["accountType"] = $account;
              // Redirect user to welcome page                       


              switch ($account)
              {
                case 1:
                  header("location: employer/");
                  exit();
                  break;
                case 2:
                  header("location: profile/");
                  exit();
                  break;
              }
            }
            else
            {
              // Display an error message if password is not valid
              $password_err = "The password you entered was not valid.";
            }
          }
        }
        else
        {
          // Display an error message if username doesn't exist
          $username_err = "No account found with that username.";
        }
      }
      else
      {
        $username_err = "Oops! Something went wrong. Please try again later.";
      }

      // Close statement
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<!--
------------------------------------
  WJC - www.wjc.edu.bz
  Version: 1.0
 --------------------------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dentium&mdash; Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i" rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <link rel="stylesheet" href="css/animate.css" />
  <link rel="stylesheet" href="css/owl.carousel.css" />
  <link rel="stylesheet" href="css/style.css" />


  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">


  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">

</head>

<body>

  <div id="page-container">
    <div id="content-wrap">
      <!-- Page Preloder -->
      <div id="preloder">
        <div class="loader"></div>
      </div>

      <!-- header section -->

      <!-- header section end-->


      <!-- Header section  -->

      <!-- Header section end -->
      <div class="text-center">
        <header class="header-section">
          <div class="container">
            <!-- logo -->
            <a href="/" class="site-logo"><img src="images/logo2.png" alt=""></a>

          </div>
        </header>

        <div class="container">
          <div class="row row-content d-flex justify-content-center">
            <div class="col-md-5 text-center">
              <h2>Welcome to Dentium</h2>
              <h4>Login</h4>
              <p>Please fill in your credentials to login.</p>
              <form action="index.php" method="post">
                <div class="form-group ">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                  <span class="help-block"><?php echo $username_err; ?></span>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control">
                  <span class="help-block"><?php echo $password_err; ?></span>
                </div>
                <div class="form-group text-center">
                  <input type="submit" class="btn btn-primary" value="Login">
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Footer section -->



        <footer class="footer-section ">

          <!-- copyright -->
          <div class="copyright text-white">
            <div class="container">

              Copyright &copy;<script>
                document.write(new Date().getFullYear());
              </script> All rights reserved | EmployMe.bz</a>

            </div>
          </div>
        </footer>
        <!-- Footer section end-->

      </div>
    </div>

  </div>

  <!--====== Javascripts & Jquery ======-->
  <script src="/dentium/js/jquery-3.2.1.min.js"></script>
  <script src="/dentium/js/owl.carousel.min.js"></script>
  <script src="/dentium/js/jquery.countdown.js"></script>
  <script src="/dentium/js/masonry.pkgd.min.js"></script>
  <script src="/dentium/js/magnific-popup.min.js"></script>
  <script src="/dentium/js/main.js"></script>

</body>

</html>