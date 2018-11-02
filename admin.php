<?php
session_start();
include_once 'dbconnect.php';
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

        /* Profile container */
        .profile {
          margin: 20px 0;
        }

        /* Profile sidebar */
        .profile-sidebar {
          padding: 20px 0 10px 0;
          background: #fff;
          box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        }

        .profile-userpic img {
          float: none;
          margin: 0 auto;
          width: 50%;
          height: 50%;
          -webkit-border-radius: 50% !important;
          -moz-border-radius: 50% !important;
          border-radius: 50% !important;
        }

        .profile-usertitle {
          text-align: center;
          margin-top: 20px;
        }

        .profile-usertitle-name {
          color: #006666;
          font-size: 18px;
          font-weight: 600;
          margin-bottom: 7px;
        }

        .profile-usertitle-job {
          text-transform: uppercase;
          color:#5a7391 ;
          font-size: 13px;
          font-weight: 600;
          margin-bottom: 15px;
        }

        .profile-userbuttons {
          text-align: center;
          margin-top: 10px;
        }

        .profile-userbuttons .btn {
          text-transform: uppercase;
          font-size: 11px;
          font-weight: 600;
          padding: 6px 15px;
          margin-right: 5px;
        }

        .profile-userbuttons .btn:last-child {
          margin-right: 0px;
        }

        .profile-usermenu {
          margin-top: 30px;
        }

        .profile-usermenu ul li {
          border-bottom: 1px solid #f0f4f7;
        }

        .profile-usermenu ul li:last-child {
          border-bottom: none;
        }

        .profile-usermenu ul li a {
          color: #93a3b5;
          font-size: 14px;
          font-weight: 400;
        }

        .profile-usermenu ul li a i {
          margin-right: 8px;
          font-size: 14px;
        }

        .profile-usermenu ul li a:hover {
          background-color: #fafcfd;
          color: #5b9bd1;
        }

        .profile-usermenu ul li.active {
          border-bottom: none;
        }

        .profile-usermenu ul li.active a {
          color: #5b9bd1;
          background-color: #f6f9fb;
          border-left: 2px solid #5b9bd1;
          margin-left: -2px;
        }

        /* Profile Content */
        .profile-content {
          padding: 20px;
          background: #fff;
          min-height: 460px;

        }

div.hero-technology{

  background-image: url("imageguest1.jpg");
  color:#fff;
  text-align:center;
  opacity: 0.8;
  padding-top:50px;
  padding-bottom:50px;
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

        <div class="container" >
    <div class="row profile">

		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="card.png" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle" style="font-family:Arial;">
					<div class="profile-usertitle-name">
						Administrator
					</div>
					<div class="profile-usertitle-job">
						Rajshahi University of Engineering and Technology
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-md">Follow</button>
					<button type="button" class="btn btn-primary btn-md">Contact</button>
				</div>

				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="#"><i class="glyphicon glyphicon-home"></i>Overview </a>
						</li>

						<li>
							<a href="#"><i class="glyphicon glyphicon-user"></i>Account Settings </a>
						</li>

						<li>
							<a href="#" target="_blank"><i class="glyphicon glyphicon-ok"></i>Tasks </a>
						</li>

						<li>
							<a href="#"><i class="glyphicon glyphicon-flag"></i>Help </a>
						</li>
					</ul>
				</div>

        <div class="container" style="padding-top:15px;">
            <a href="#"><i class="fa fa-dribbble fa-2x"></i> 	&nbsp;</a>
            <a href="#"><i class="fa fa-twitter fa-2x"></i> 	&nbsp;</a>
            <a href="#"><i class="fa fa-linkedin fa-2x"></i> 	&nbsp;</a>
            <a href="#"><i class="fa fa-facebook fa-2x"></i> 	&nbsp;</a>
            <a href="#"><i class=" fa fa-google-plus fa-2x"></i> 	&nbsp;</a>
            <a href="#"><i class=" 	fa fa-quora fa-2x"></i> 	&nbsp;</a>
        </div>

				<!-- END MENU -->
			</div>
		</div>

		<div class="col-md-9">
            <div class="profile-content">

    <div class="hero-technology">
        <h1 class="hero-title">RUET GUEST HOUSE</h1>
        <p><a class="btn btn-primary btn-lg hero-button" role="button" href="notifications.php">New Notifications</a></p>
        <p><a class="btn btn-primary btn-lg hero-button" role="button" href="current.php" >Current Allocations</a></p>
    </div>


            </div>

		</div>
	</div>
</div>

        <div class="container-fluid">
           <h4 style="text-align:center; background-color: #339961;color:azure; padding:20px 0px; font-size:16px;"> &copy; DEPARTMENT OF CSE, RUET, 2017</h4>
        </div>

    </body>

</html>
