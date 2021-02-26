

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Sign up</title>
  </head>
  <body>  

    <?php
        require "partials/_nav.php";

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $err = '';
            include "partials/_dbConnect.php";

            $uname = $_POST['uname'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpassword'];

            $exists = "SELECT * FROM register WHERE uname = '$uname' OR email = '$email'";
            $result = mysqli_query($conn, $exists);
            $numExistsRows = mysqli_num_rows($result);

            if($numExistsRows>0){
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error!</strong> Username or email already exists.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
            }
            else{
              if($pass == $cpass){
                $hash = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `register` (`uname`, `fname`, `lname`, `email`, `password`, `dob`, `doj`) VALUES ('$fname', '$fname', '$lname', '$email', '$hash', '$dob', current_timestamp());";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You can now log in.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                    header("location: login.php");
                  }else{
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> Fill the credentials carefully. '.mysqli_error($conn).'
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
                  }
              }
              else{
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Password did not match.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
              }
            }
        }


  ?>

    <div class="container mt-3 mb-3">
    <h1>Sign up</h1>
        <form action="/php-tutorial/signup.php" method="post">
        <div class="mb-3 col-md-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" maxlength="11" name="fname" class="form-control" id="fname" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 col-md-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" maxlength="11" name="lname" class="form-control" id="lname" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 col-md-3">
            <label for="uname" class="form-label">User Name</label>
            <input type="text" maxlength="10" name="uname" class="form-control" id="uname" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 col-md-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" id="dob" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 col-md-6">
            <label for="email" class="form-label">Email address</label>
            <input type="email" maxlength="25" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" maxlength="11" name="password" class="form-control" id="password">
        </div>
        <div class="mb-3 col-md-6">
            <label for="cpassword" class="form-label">Confirm password</label>
            <input type="password" maxlength="11" name="cpassword" class="form-control" id="cpassword">
            <div id="emailHelp" class="form-text">Make sure to type the same password.</div>
        </div>
        <button type="submit" class="btn btn-primary col-md-6">SignUp</button>
        </form>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>