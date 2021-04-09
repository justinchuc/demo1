<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tasks &mdash; EmployMe.bz </title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">EmployMe.bz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="../employer/">Home</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="tasks.php">Tasks</a>
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
  <!--nav end -->

  <div class="container"> <br>
    <div class="row">
      <div class="col-12">
        <button class="btn btn-primary" data-toggle="modal" data-target="#createTask">Create Task</button>
      </div>
    </div>
    <!-- Create Patients Modal -->
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
            <form action="" name="createTask" onsubmit="" method="post">

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
              <div class="form-row mt-2">
                <div class="form-group col-md-6">
                  <label class="ml-3">Min Price</label>
                  <input type="text" id="createminprice" name="create_minprice" class="form-control" required>
                  <span id="errorMinPrice" class="help-block text-danger"></span>
                </div>
                <div class="form-group col-md-6">
                  <label class="ml-3">Max Price</label>
                  <input type="text" id="createmaxprice" name="create_maxprice" class="form-control" required>
                  <span id="errorMaxPrice" class="help-block text-danger"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="ml-3">Location</label>
                <input type="text" id="createtlocation" name="create_tlocation" class="form-control">
                <span id="errorLocation" class="help-block text-danger"></span>
              </div>
              <div class="form-group text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              <input type="hidden" name="action" value="createTask">
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- modal end -->
    <hr>
    <div class="row">
      <div class="text-center col-lg-6 offset-lg-3">
        <p>Copyright &copy; 2020 &middot; All Rights Reserved &middot; <a href="#">EmployME.bz</a></p>
      </div>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>