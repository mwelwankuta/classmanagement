<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'davy') {
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Class Management System</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body>

  <header>
    <h1 id="title">Class Management System</h1>
    <div class="navbar">
      <a href="index.php" >Home</a>
      <a href="students.php" >Students</a>
      <a href="teachers.php" >Teachers</a>
      <a href="attendance.php" >Attendance</a>
      <a href="report.php" style="flex:1;">Report</a>
      <a href="../logout.php" id="logout">Logout</a>
    </div>

  </header>

  <center>

    <div class="row">
      <div class="content">
        <img src="../img/att.png" width="400px" />

      </div>

    </div>

  </center>

</body>

</html>