<?php
 session_start();

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($password != $cpassword) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }

    if (!$error) {
        if(mysqli_query($con, "INSERT INTO users(name,email,password,role) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "','user')")) {
            $successmsg = "Successfully Registered!";
        }
    }
    else {
            $errormsg = "Error in registering...Please try again later!";
        }
}
?>


<!DOCTYPE html>
<html lang="en">

    <head>
     <title>Sign Up</title>
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

          .error {color: #eb2d53;}
          .success {color:green;}

        </style>

    </head>

    <body>
        <div class="container-fluid" style="background-color:#16837d;" >
            <h1 class="text-center" style="color:white; padding: 25px;"> Rajshahi University of Engineering and Technology</h1>
        </div>

        <div id="mySidenav" class="sidenav">
             <a href="login.php" id="login" align="right"><span class="glyphicon glyphicon-log-in"></span> &nbsp; Login</a>
        </div>

        <div class="container">
           <h3 style="margin-top:40px;text-align: center;font-size:30px;">Sign Up</h3>
           <p style="text-align:center;font-size:20px;color:#999999; padding-bottom:20px; border-bottom:2px solid #bfbfbf;">Sign up to join the community</p>

        </div>

        <div class="container" style="width:38%; margin:auto; margin-top:30px; border-radius: 5px; background-color:#c4e3ed;  padding: 20px;">

          <h3 style="font-size-adjust:.60;text-align:center;margin-top:1px;">Create an account</h3>
          <p style="opacity:0.6; text-align:center;">Note: <span> All fields are required</span></p>


           <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
             <div class="form-group">
                 <label for="name">Full Name:</label>
                 <input type="text" class="form-control input-lg" name="name" placeholder="Full Name" required>
                 <span class="error"> <?php if (isset($name_error)) echo $name_error; ?> </span>
             </div>

            <div class="form-group">
                <label for="email"> Email:</label>
                <input type="text" class="form-control input-lg" name="email" placeholder="Enter Email" required>
                <span class="error"><?php if (isset($email_error)) echo $email_error; ?></span>
            </div>

            <div class="form-group">
                  <label for="name">Password:</label>
                  <input type="password" class="form-control input-lg" name="password" placeholder="Give password" required>
                  <span class="error"><?php if (isset($password_error)) echo $password_error; ?></span>
            </div>

            <div class="form-group">
                  <label for="name">Confirm Password:</label>
                  <input type="password" class="form-control input-lg" name="cpassword" placeholder="Confirm Password" required>
                  <span class="error"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
            </div>

            <div class="checkbox">
                <label><input type="checkbox"> I agree to the sites terms of use.</label>
            </div>

               <button type="submit" name="signup" value="Sign Up" class="btn btn-primary btn-lg btn-block" >Submit</button>

            </form>

            <span class="success"><?php if (isset($successmsg)) { echo $successmsg; echo '<a href="login.php" style="text-decoration:none; color:steelblue;"> Click here to login</a>'; } ?></span>
                      <span class="error"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

         </div>



        <div class="container" style="margin-top: 10px; text-align: center;">
          <p style="font-size:20px; color:#4d4d4d;">Already have an account?</p>
          <a href="login.php" style="font-size:18px; color:#16837d; text-decoration:none; font-size-adjust:0.6;">Login Here</a>
        </div>

        <div class="container-fluid">
           <h4 style="text-align:center; background-color: #339961;color:azure; padding:20px 0px; font-size:16px;"> &copy; DEPARTMENT OF CSE, RUET, 2017</h4>
        </div>

    </body>

</html>
