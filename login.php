<?php
 session_start();

include_once 'dbconnect.php';

//check if form is submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email. "' and password = '" . md5($password) . "'");
    //echo "<h2>$result</h2>";
    if ($row = mysqli_fetch_array($result)) {
        $_SESSION['usr_id'] = $row['id'];
        $_SESSION['usr_name'] = $row['name'];
        $_SESSION['usr_role'] = $row['role'];

        if($_SESSION['usr_role']=="admin"){
          header("Location: admin.php");
        }
        else {
          header("Location: user.php");
        }


    }

    else {
        $errormsg = "Incorrect Email or Password!!!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
     <title>Login</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <style>

        #mySidenav a {
          position: fixed;
          transition: 0.3s;
          padding: 10px;
          text-decoration: none;
          font-size: 20px;
          color: white;
          border-radius: 5px 5px 5px 5px;
          }

          #mySidenav a:hover {
          right: 0;
          }

          #login {
          right: -60px;
          width: 110px;
          top: 125px;
          background-color: #f44336;
          }

          #signup {
            right: -80px;
            width: 130px;
          top: 125px;
          background-color: #2196F3;
          }
        </style>

    </head>

    <body>
        <div class="container-fluid" style="background-color:#16837d;" >
            <h1 class="text-center" style="color:white; padding: 25px;"> Rajshahi University of Engineering and Technology</h1>
        </div>

        <div id="mySidenav" class="sidenav">
             <a href="signup.php" id="signup" align="right"><span class="glyphicon glyphicon-new-window"></span> &nbsp; SignUp</a>
        </div>

        <div class="container">
           <h3 style="margin-top:40px;text-align: center;font-size:25px;">Login</h3>
           <p style="text-align:center;font-size:20px;color:#999999; padding-bottom:20px; border-bottom:2px solid #bfbfbf;">Login to Access</p>

        </div>

        <div class="container" style="width:38%; margin:auto; margin-top:30px; border-radius: 5px; background-color:#cac4ed;  padding: 20px;">

           <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="form-group">
                <label for="name"> Email:</label>
                <input type="email" class="form-control input-lg" name="email" placeholder="Enter Email" required>
            </div>

            <div class="form-group">
                  <label for="name">Password:</label>
                  <input type="password" class="form-control input-lg" name="password" placeholder="Enter password" required>
            </div>

            <div class="checkbox">
                <label><input type="checkbox"> Remember me</label>
            </div>

               <button type="submit" name="login" value="Sign in" class="btn btn-primary btn-lg btn-block" >Submit</button>

            </form>

            <span class="error"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

         </div>



        <div class="container" style="margin-top: 10px; text-align: center;">
          <p style="font-size:20px; color:#4d4d4d;">Don't have an account?</p>
          <a href="signup.php" style="font-size:18px; color:#16837d; text-decoration:none; font-size-adjust:0.6;">Create Account</a>
        </div>

        <div class="container-fluid">
           <h4 style="text-align:center; background-color: #339961;color:azure; padding:20px 0px; font-size:16px;"> &copy; DEPARTMENT OF CSE, RUET, 2017</h4>
        </div>

    </body>

</html>
