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
  <link rel="manifest" href="../../images/site.webmanifest">

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
            <form>
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="firstName">First Name</label>
                  <input type="text" class="form-control" id="firstName" placeholder="First Name" required>
                </div>
                <div class="form-group col-md-4">
                  <label for="lastName">Last Name</label>
                  <input type="text" class="form-control" id="lastName" placeholder="Last Name" required>
                </div>
                <div class="col-md-4">
                  <label for="validationServerUsername">Username</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend3">@</span>
                    </div>
                    <input type="text" class="form-control" id="validationServerUsername" placeholder="Username" aria-describedby="inputGroupPrepend3" required>
                    
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" required>
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" required>
              </div>
              <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" required>
              </div>

              <div class="form-group">
                <label for="inputCity">City/Town/Village</label>
                <input type="text" class="form-control" id="inputLocation" required>
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