<?php
session_start();
include_once 'dbconnect.php';



?>

<!DOCTYPE html>
<html lang="en">
  <h1>Welcome, <?php echo $_COOKIE['usr_name']; ?></h1>

</html>
