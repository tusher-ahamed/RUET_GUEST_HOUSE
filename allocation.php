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
    $numberofroom = mysqli_real_escape_string($con, $_POST['number']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $roomtype=  mysqli_real_escape_string($con, $_POST['roomtype']);
    $datefrom = mysqli_real_escape_string($con, $_POST['datefrom']);
    $dateto = mysqli_real_escape_string($con, $_POST['dateto']);

    $currentdate=  date("Y/m/d");


      require('fpdf/fpdf.php');

      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->SetFont('Times','',16);

      $pdf->Image('fpdf/logo.jpg',10,6,30);

      $pdf->Ln(12);

      $pdf->Cell(0,10,'Heavens Light Is Our Guide',0,1,'C');
      $pdf->SetFont('Arial','B',20);
      $pdf->Cell(0,10,'Rajshahi University of Engineering & Technology',0,1,'C');
      $pdf->SetFont('Times','',16);

      $pdf->Ln(5);
      $pdf->Cell(0,0,'Guest House Allocation Form',0,1,'C');
      $pdf->Ln(5);
      $pdf->Cell(0,0,'',1,1,'C');


      $pdf->Ln(14);

      $pdf->SetFont('Arial','B',15);
      $pdf->Cell(17,10,'Name:',0,0,'L');
      $pdf->SetFont('Times','',16);
      $pdf->Cell(64,10,$name,0,0,'L');

      $pdf->SetFont('Arial','B',15);
      $pdf->Cell(44,10,'Form Generated:',0,0,'L');
      $pdf->SetFont('Times','',16);
      $pdf->Cell(0,10,$currentdate,0,0,'L');



      $pdf->Ln(10);

      $pdf->SetFont('Arial','B',15);
      $pdf->Cell(34,10,'Designation:',0,0,'L');
      $pdf->SetFont('Times','',16);
      $pdf->Cell(47,10,$designation,0,0,'L');

      $pdf->SetFont('Arial','B',15);
      $pdf->Cell(25,10,'Location:',0,0,'L');
      $pdf->SetFont('Times','',16);
      $pdf->Cell(0,10,$location,0,0,'L');

      $pdf->Ln(10);

      $pdf->SetFont('Arial','B',15);
      $pdf->Cell(36,10,'No of Rooms:',0,0,'L');
      $pdf->SetFont('Times','',16);
      $pdf->Cell(43,10,$numberofroom,0,0,'L');

      $pdf->SetFont('Arial','B',15);
      $pdf->Cell(45,10,'Allocated Room:',0,0,'L');
      $pdf->SetFont('Times','',16);
      $pdf->Cell(0,8,'',1,1,'L');



      $pdf->SetFont('Arial','B',15);
      $pdf->Cell(34,10,'Room Type:',0,0,'L');
      $pdf->SetFont('Times','',16);
      $pdf->Cell(43,10,$roomtype,0,0,'L');

      $pdf->Ln(25);

      $pdf->SetFont('Times','',14);
      $pdf->Cell(17,10,"{$designation} {$name}, hereby, assigned room in the RUET GUEST HOUSE from ",0,1,'L');
      $pdf->Cell(17,10,"{$datefrom} to {$dateto} given that he/she will be obliged to the terms and condtions.",0,1,'L');
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(17,10,"(N.B: Room No will be allocated after reaching the GUEST HOUSE)",0,1,'L');



      $pdf->Ln(30);

      $pdf->SetFont('Times','',10);
      $pdf->Cell(42,0,'',1,1,'L');
      $pdf->Cell(17,10,'MEMBER',0,1,'L');
      $pdf->Cell(17,10,'GUEST HOUSE EXECUTIVE COMMITTEE',0,1,'L');
      $pdf->Cell(17,10,'RUET',0,1,'L');

      $pdf->Output('F','C:\xampp\htdocs\project2\Downloads\GuestAllocationFrom.pdf');


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

$body='Dear '.$name."\r\n".'Your request has been accepted for residence in the RUET GUEST HOUSE. Please, come along with a printed copy of the GUEST ALLOCATION FORM attached here.'."\r\n"."\r\n".'BR'."\r\n".'Guest House Committee.';                                  // Set email format to HTML

$mail->Subject = 'Guest House Request Accepted';
$mail->Body    = $body;

$mail->AddAttachment('C:\xampp\htdocs\project2\Downloads\GuestAllocationFrom.pdf', '', $encoding = 'base64', $type = 'application/pdf');


if(!$mail->send()) {
    echo 'Mail could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Mail has been sent';
}



    //name can contain only alpha characters and space
    if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
        $error = true;
        $name_error = "Name must contain only alphabets and space";
    }


    if (!$error) {
        if(mysqli_query($con, "INSERT INTO room_allocation(name,designation,no_of_room,location,roomtype,datefrom,dateto) VALUES('" . $name . "', '" . $designation . "','" . $numberofroom . "','" . $location . "','" . $roomtype . "','" . $datefrom . "','" . $dateto . "')")) {
            $successmsg = "Successfully, Entered into the database.";
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
     <title>Guest House: Allocation</title>
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
           <h3 style="margin-top:40px;text-align: center;font-size:25px;">New Allocation</h3>
           <p style="text-align:center;font-size:20px;color:#999999; padding-bottom:20px; border-bottom:2px solid #bfbfbf;">Admin should allocate if only available.</p>

        </div>

        <div class="container" style="width:38%; margin:auto; margin-top:30px; border-radius: 5px; background-color:#cfe2e2;  padding: 20px;">

            <h3 style="font-size-adjust:.60;text-align:center;margin-top:1px;">Complete the form</h3>

           <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" name="signupform">

            <div class="form-group">
                <label for="name">Full Name:</label>
                <p class="form-control-static" style="border: 1px solid #eff5f5; border-radius:5px; background-color:#eff5f5; padding:5px; font-size:16px;"><?php if (!isset($_POST['submit'])){echo $_GET['name'];} ?></p>
                <input type="hidden" class="form-control-static input-md" name="name" value="<?php echo $_GET['name'] ?>"  required>

            </div>

            <div class="form-group">
                <label for="email"> Email:</label>
                  <p class="form-control-static" style="border: 1px solid #eff5f5; border-radius:5px; background-color:#eff5f5; padding:5px; font-size:16px;"><?php if (!isset($_POST['submit'])){echo $_GET['email'];} ?></p>
                <input type="hidden" class="form-control input-md" name="email" value="<?php echo $_GET['email'] ?>"  required>

            </div>

               <div class="form-group">
               <label for="designation"> Designation:</label>
               <p class="form-control-static" style="border: 1px solid #eff5f5; border-radius:5px; background-color:#eff5f5; padding:5px; font-size:16px;"><?php if (!isset($_POST['submit'])){ echo $_GET['designation'];} ?></p>
             <input type="hidden" class="form-control input-md" name="designation" value="<?php echo $_GET['designation'] ?>"  required>

               </div>

               <div class="form-group">
                <label for="numberguest">Number of Guests:</label>
                <p class="form-control-static" style="border: 1px solid #eff5f5; border-radius:5px; background-color:#eff5f5; padding:5px; font-size:16px;"><?php if (!isset($_POST['submit'])){echo $_GET['guestno'];} ?></p>
              <input type="hidden" class="form-control input-md" name="numberguest" value="<?php echo $_GET['guestno'] ?>"  required>
            </div>

            <div class="form-group">
             <label for="number">Number of Rooms (Enter Total)</label>
             <input type="number" class="form-control input-md" name="number"  min="1" max="20" value="1" required>
         </div>

               <div class="form-group" >
               <label for="location"> Location:</label>
               <p class="form-control-static" style="border: 1px solid #eff5f5; border-radius:5px; background-color:#eff5f5; padding:5px; font-size:16px;"><?php if (!isset($_POST['submit'])){echo $_GET['location'];} ?></p>
             <input type="hidden" class="form-control input-md" name="location" value="<?php echo $_GET['location'] ?>"  required>
               </div>


             <div class="form-group" >
             <label for="roomtype"> Room Type (Select this option)</label>
                 <select class="form-control input-md" name="roomtype"  required>
                  <option value="AC">AC</option>
                  <option value="NON-AC">Non-AC</option>
                 </select>
             </div>


                <div class="form-group">
                    <div class="col-xs-6">
                 <label for="datefrom">From:</label>
                 <p class="form-control-static" style="border: 1px solid #eff5f5; border-radius:5px; background-color:#eff5f5; padding:5px; font-size:16px;"><?php if (!isset($_POST['submit'])){echo $_GET['datefrom'];} ?></p>
               <input type="hidden" class="form-control input-md" name="datefrom" value="<?php echo $_GET['datefrom'] ?>"  required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-6">
                    <label for="dateto">To:</label>
                    <p class="form-control-static" style="border: 1px solid #eff5f5; border-radius:5px; background-color:#eff5f5; padding:5px; font-size:16px;"><?php if (!isset($_POST['submit'])){echo $_GET['dateto'];} ?></p>
                  <input type="hidden" class="form-control input-md" name="dateto" value="<?php echo $_GET['dateto'] ?>"  required>
                    </div>
                </div>

               <button type="submit" class="btn btn-success btn-md btn-block" name="submit" style="margin-top: 100px;">Submit</button>

            </form>

              <span class="success"><?php if (isset($successmsg)) { echo $successmsg; echo '<a href="notifications.php" style="text-decoration:none; color:steelblue;"> Go Back</a>'; } ?></span>
                      <span class="error"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

         </div>


        <div class="container-fluid">
           <h4 style="text-align:center; background-color: #339961;color:azure; padding:20px 0px; font-size:16px;"> &copy; DEPARTMENT OF CSE, RUET, 2017</h4>
        </div>

    </body>

</html>
