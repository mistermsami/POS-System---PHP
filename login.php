<?php
session_start();

  if(!empty($_SESSION['ad_id']))
{
  header("location:home.php");
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <?php include('include/headlinks.php') ?>

    <style>
    html,
body {
  height: 100%;
}

body {
  display: flex;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}

.form-signin .checkbox {
  font-weight: 400;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .form-floating a{
        text-decoration: none;
        color: #037aad;
        font-weight: bold;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <!-- <link href="signin.css" rel="stylesheet"> -->
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="" method="POST">
    <!-- <img class="mb-4" src="images/hilals.jpg" alt="" width="" height="120px"> -->
    <h3 class="mb-4">Hilal's Food Admin</h3>
    <h1 class="h3 mb-3 fw-normal"></h1>

    <div class="form-floating">
      <label for="floatingInput" style="float:left;">Uesename</label>
      <input type="text" name="username" class="form-control" id="floatingInput" placeholder="username" required>
      
    </div>
    <div class="form-floating">
      <label for="floatingPassword" style="float:left;">Password</label>
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
      
    </div>
    <!-- <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div> -->
    <br>
    <button class="w-100 btn btn-lg btn-primary" type="submit" name="btnsubmit">Login</button>
  </form>
</main>
<?php

    include("include/pdo.php");
  if (isset($_POST['btnsubmit'])) {
    
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query="select * from admin where ad_name='$username' and ad_password='$password'";
        $result=$conn->query($query);
        $rowcount=$result->rowCount();
  if($rowcount>0) {
    foreach ($result as $row) {
        $_SESSION['ad_id']=$row['ad_id'];
        $_SESSION['ad_name']=$row['ad_name'];

         echo "<script>window.location.href='home.php' </script>";


    }
  }
  else{
    echo "<script type='text/javascript'>alert('Invailed Email or Password!')</script>";
  }
  }
  ?>
  </body>
</html>

