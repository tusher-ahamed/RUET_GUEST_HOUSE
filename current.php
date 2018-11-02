<?php
 session_start();

include_once 'dbconnect.php';

$totalraj=40;
$totaldha=15;

//check if form is submitted
if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $result = mysqli_query($con, "DELETE FROM room_allocation WHERE name = '" . $name. "' and id = '" . $id . "'");

   if($result) {
     header("Location: current.php");



   }
}

$result2 = mysqli_query($con, "SELECT SUM(no_of_room) as tt FROM room_allocation where location='RUET'");

if ($row = mysqli_fetch_array($result2)) {

   $allocated=$row['tt'];
   $remainingraj=$totalraj-$allocated;
}

$result3 = mysqli_query($con, "SELECT SUM(no_of_room) as tt FROM room_allocation where location='Dhaka'");

if ($row = mysqli_fetch_array($result3)) {

   $allocated=$row['tt'];
   $remainingdha=$totaldha-$allocated;
}




?>

<!DOCTYPE html>
<html lang="en">

    <head>
     <title>Admin</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link href='https://fonts.googleapis.com/css?family=Roboto:400,700' rel='stylesheet' type='text/css'>
	   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <style>
        body {
          background: #F1F3FA;
        }


        .profile-content {
          padding: 5px;
          background: #fff;
          min-height: 400px;
          max-width: auto;
          margin: 20px;

        }


        </style>

    </head>

    <body>
        <div class="container-fluid" style="background-color:#16837d;" >
            <h1 class="text-center" style="color:white; padding: 25px;"> Rajshahi University of Engineering and Technology</h1>
        </div>

    <nav class="navbar" style="border-bottom:2px solid   #25dad1;">

  <div class="container-fluid">

    <ul class="nav navbar-nav navbar-right">

      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" style="font-size:18px; color:#16837d;">Welcome, <?php echo $_SESSION['usr_name']; ?> <span class="caret"></span>&nbsp; &nbsp;&nbsp;</a>
        <ul class="dropdown-menu">
          <li><a href="admin.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
          <li class="divider"></li>
          <li><a href="#"><span class="glyphicon glyphicon-cog"></span> Preferences</a></li>
          <li class="divider"></li>
          <li><a href="#"><span class="glyphicon glyphicon-envelope"></span> Contact Support</a></li>
          <li class="divider"></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
        </ul>
      </li>
    </ul>

  </div>
</nav>


            <div class="profile-content">

              <div class="container fluid">
     <h2>Current Allocation on Guest House</h2>
     <table class="table table-bordered table-hover" >
       <thead>
         <tr>
           <th>Name</th>
           <th>Designation</th>
           <th>No of Rooms</th>
           <th>Location</th>
           <th>Room type</th>
           <th>Date From</th>
           <th>Date To</th>
           <th>Removal</th>
         </tr>
       </thead>
       <tbody>

         <?php
             $result = mysqli_query($con, "SELECT * FROM room_allocation WHERE value= '0'");
             while($row = mysqli_fetch_array($result)) {
             ?>
                 <tr>
                     <td><?php echo $row['name']?></td>
                     <td><?php echo $row['designation']?></td>
                     <td><?php echo $row['no_of_room']?></td>
                     <td><?php echo $row['location']?></td>
                     <td><?php echo $row['roomtype']?></td>
                     <td><?php echo $row['datefrom']?></td>
                     <td><?php echo $row['dateto']?></td>
                     <td>
                       <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                          <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
                          <input type="hidden" name="name" value="<?php echo $row['name'] ?>" />
                          <button type="submit" name="submit" value="Submit" class="btn btn-danger">Remove</button>
                        </form>
                     </td>
                 </tr>

             <?php
             }
             ?>
       </tbody>
     </table>
   </div>


   <div class="container fluid" style="width:50%;">
<h3>Guest House, RUET</h3>
<table class="table table-bordered table-hover" >
<thead>
<tr>
<th>Total Number of Rooms</th>
<th>Available Rooms</th>
</tr>
</thead>
<tbody>
      <tr>
          <td><?php echo $totalraj?></td>
          <td><?php echo $remainingraj?></td>
      </tr>
</tbody>
</table>
</div>

<div class="container fluid" style="width:50%;">
<h3>Guest House, Dhaka</h3>
<table class="table table-bordered table-hover" >
<thead>
<tr>
<th>Total Number of Rooms</th>
<th>Available Rooms</th>
</tr>
</thead>
<tbody>
   <tr>
       <td><?php echo $totaldha?></td>
       <td><?php echo $remainingdha?></td>
   </tr>
</tbody>
</table>
</div>


            </div>





        <div class="container-fluid">
           <h4 style="text-align:center; background-color: #339961;color:azure; padding:20px 0px; font-size:16px;"> &copy; DEPARTMENT OF CSE, RUET, 2017</h4>
        </div>

    </body>

</html>
