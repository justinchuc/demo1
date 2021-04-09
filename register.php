<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register &mdash; EmployMe.bz</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap-4.4.1.css" rel="stylesheet">

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">EmployMe.bz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item"> </li>
        <li class="nav-item dropdown">
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
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

  <div class="jumbotron jumbotron-fluid text-center">
    <h1 class="display-4">Registering</h1>
    <hr class="my-4">
    <form>
      <div class="form-group col-xl-4">
        <label for="exampleInputEmail1">Full Name</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
        <small id="emailHelp1" class="form-text text-muted">&nbsp;</small>
      </div>
      <div class="form-group col-xl-4">
        <label for="exampleInputEmail2">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
        <small id="emailHelp2" class="form-text text-muted">&nbsp;</small>
      </div>
      <div class="form-group col-xl-4">
        <label for="exampleInputPassword1">DOB</label>
        <label for="date">:</label>
        <input type="date" name="date" id="date">
      </div>
    </form>
    <form>
      <div class="form-group col-xl-4">
        <label for="exampleInputEmail3">Interests</label>
        <small id="emailHelp3" class="form-text text-muted">&nbsp;</small>
        <table width="200">
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_0">
                Construction</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_1">
                Mail Service</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_2">
                Driver</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_3">
                Delivery Person</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_4">
                Landscape</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_5">
                PC Repair</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_6">
                Mechanic</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_7">
                Plumer</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_8">
                Web Designer</label></td>
          </tr>
          <tr>
            <td><label>
                <input type="checkbox" name="CheckboxGroup1" value="checkbox" id="CheckboxGroup1_9">
                Checkbox</label></td>
          </tr>
        </table>
      </div>
      <div class="form-group col-xl-4">
        <label for="exampleInputPassword2">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password">
      </div>
    </form>
    <button type="submit" class="btn btn-primary">Submit</button>
    <p class="lead">&nbsp; </p>
  </div>
  <div class="container"> <br>
    <hr>
    <br>
    <br>
    <hr>
    <div class="row">
      <div class="text-center col-lg-6 offset-lg-3">
        Copyright &copy;
        <script>
            document.write(new Date().getFullYear());
        </script> All rights reserved | EmployMe.bz
      </div>
    </div>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery-3.4.1.min.js"></script>

  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap-4.4.1.js"></script>
</body>

</html>