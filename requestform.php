<?php
 session_start();

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $designation = mysqli_real_escape_string($con, $_POST['designation']);
    $numberofguest = mysqli_real_escape_string($con, $_POST['number']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $datefrom = mysqli_real_escape_string($con, $_POST['datefrom']);
    $dateto = mysqli_real_escape_string($con, $_POST['dateto']);



    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }




    if (!$error) {
        if(mysqli_query($con, "INSERT INTO request(name,email,designation,no_of_guest,location,datefrom,dateto,value) VALUES('" . $name . "', '" . $email . "', '" . $designation . "','" . $numberofguest . "','" . $location . "','" . $datefrom . "','" . $dateto . "','1')")) {
            $successmsg = "Successfully submitted! Please wait for at least 1 day for confirmation in your email";
        }
    }
    else {
            $errormsg = "Error in registering...Please try again later!";
        }


        require 'PHPMailer/PHPMailerAutoload.php';

  $mail = new PHPMailer();

  //$mail->SMTPDebug = 1;                               // Enable verbose debug output

  $mail->Host = 'smtp.gmail.com';

  $mail->isSMTP();                                      // Set mailer to use SMTP
   // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication

  $mail->Username = 'guesthouse.ruet@gmail.com';                 // SMTP username
  $mail->Password = 'hurrayadmin';                           // SMTP password

  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 465;                                    // TCP port to connect to

  $mail->setFrom('guesthouse.ruet@gmail.com', 'Admin');
  $mail->addAddress($email, 'User');     // Add a recipient
  //$mail->addAddress('ellen@example.com');               // Name is optional
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  //$mail->isHTML(true);

  $body=.$designation.' '.$name.' has sent you a new request for residence in RUET Guest house. Comply now.';                                  // Set email format to HTML

  $mail->Subject = 'New Guest House Request';
  $mail->Body    = $body;


  if(!$mail->send()) {
      echo 'Request could not be sent now. Try again later.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      echo 'Mail has been sent';
  }


}
?>



<!DOCTYPE html>
<html lang="en">

    <head>
     <title>Guest House: Request</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <style>


        .error {color: #eb2d53;}
        .success {color:#1c1c7d;}

        </style>

    </head>

    <body>
        <div class="container-fluid" style="background-color:#16837d;" >
            <h1 class="text-center" style="color:white; padding: 25px;"> Rajshahi University of Engineering and Technology</h1>
        </div>



        <div class="container">
           <h3 style="margin-top:40px;text-align: center;font-size:25px;">Guest House</h3>
           <p style="text-align:center;font-size:20px;color:#999999; padding-bottom:20px; border-bottom:2px solid #bfbfbf;">Get Your Accomodation on RUET Guest House</p>

        </div>

        <div class="container" style="width:38%; margin:auto; margin-top:30px; border-radius: 5px; background-color:  #bef4f1;  padding: 20px;">

            <h3 style="font-size-adjust:.60;text-align:center;margin-top:1px;">Your Information</h3>
            <p style="opacity:0.6; text-align:center;">Note: <span> All fields are required</span></p>

           <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">

            <div class="form-group">
                <label for="name">Full Name *</label>
                <input type="text" class="form-control input-md" name="name" placeholder="Full Name" required>
                <span class="error"> <?php if (isset($name_error)) echo $name_error; ?> </span>
            </div>

            <div class="form-group">
                <label for="email"> Email *</label>
                <input type="email" class="form-control input-md" name="email" placeholder="Enter Email" required>
                <span class="error"><?php if (isset($email_error)) echo $email_error; ?></span>
            </div>

               <div class="form-group">
               <label for="designation"> Designation *</label>
                   <select class="form-control input-md" name="designation" required>
                    <option value="Professor">Professor</option>
                    <option value="Assistant profesor">Assistant Professor</option>
                    <option value="Lecturer">Lecturer</option>
                    <option value="Administration">Administration</option>
                    <option value="Staff">Staff</option>
                   </select>
               </div>

               <div class="form-group">
                <label for="number">Number of Guest</label>
                <input type="number" class="form-control input-md" name="number"  min="1" max="10" value="1" required>
            </div>

               <div class="form-group" >
               <label for="location"> Location *</label>
                   <select class="form-control input-md" name="location"  required>
                    <option value="Dhaka">Dhaka</option>
                    <option value="RUET">RUET</option>
                   </select>
               </div>


                <div class="form-group">
                    <div class="col-xs-6">
                 <label for="datefrom">From:</label>
                  <input type="date" class="form-control input-md"  name="datefrom"  required >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6">
                    <label for="dateto">To:</label>
                   <input type="date" class="form-control input-md" name="dateto"   required >
                    </div>
                </div>

               <button type="submit" class="btn btn-success btn-md btn-block" name="submit" style="margin-top: 100px;">Submit</button>

            </form>

            <span class="success"><?php if (isset($successmsg)) { echo $successmsg; echo '<a href="user.php" style="text-decoration:none; color:steelblue;"> Go Back</a>'; } ?></span>
                      <span class="error"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

         </div>


        <div class="container-fluid">
           <h4 style="text-align:center; background-color: #339961;color:azure; padding:20px 0px; font-size:16px;"> &copy; DEPARTMENT OF CSE, RUET, 2017</h4>
        </div>

    </body>

</html>
