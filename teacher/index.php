<?php

ob_start();
session_start();
include "connect.php";

if ($_SESSION['name'] != 'davy') {
  header('location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>CMS | Home</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/main.css">

</head>

<body class="container">

  <header>
    <h3 class="main-title">CMS</h3>
    <nav>
      <div class="navbar">
        <a href="index.php">
          <div><img src="https://img.icons8.com/material/24/ffffff/home--v5.png" /></div>
          <p>Home</p>
        </a>
        <a href="students.php">
          <div><img src="https://img.icons8.com/material/24/ffffff/student-registration.png" /></div>
          <p>Students</p>
        </a>
        <a href="attendance.php">
          <div><img src="https://img.icons8.com/material/24/ffffff/group-foreground-selected.png" /></div>
          <p>Attendance</p>
        </a>
        <a href="report.php" style="flex: 1;">
          <div><img src="https://img.icons8.com/material/24/ffffff/statistic-document.png" /></div>
          <p>Report</p>
        </a>
      </div>
      <div class="logout-btn">
        <a href="../logout.php" id="logout">
          <img src="https://img.icons8.com/material/24/ff0000/export--v2.png" />
          <p>Logout</p>
        </a>
      </div>
    </nav>

  </header>

  <main>
    <h1 class="main-title">Class Information</h1>
    <div class="cards-holder">
      <div class="card">
        <h1>
          <?php
          $sql = "SELECT * FROM teachers;";
          $result = mysqli_query($connection, $sql);
          $number = mysqli_num_rows($result);
          echo $number;
          ?>
        </h1>
        <h3>Teachers</h3>
        <img src="https://img.icons8.com/pastel-glyph/64/FFFFFF/classroom.png" />
      </div>

      <div class="card">
        <h1>
          <?php
          $sql = "SELECT * FROM students;";
          $result = mysqli_query($connection, $sql);
          $number = mysqli_num_rows($result);
          echo $number;
          ?>
        </h1>
        <h3>Students</h3>
        <img src="https://img.icons8.com/pastel-glyph/64/FFFFFF/graduation-cap--v1.png" />
      </div>

      <div class="card">
        <h1>
          <?php
          $today_date = date('Y-m-d');
          $sql = "SELECT * FROM attendance WHERE st_status='Absent' and stat_date='$today_date' GROUP BY stat_id ;";
          $result = mysqli_query($connection, $sql);
          $number = mysqli_num_rows($result);
          echo $number;
          ?>
        </h1>
        <h3>Students Absent Today</h3>
        <img src="https://img.icons8.com/pastel-glyph/64/FFFFFF/cloud-user-group.png" />
      </div>

    </div>

    <div class="reports">
      <div class="card">
        <div class="row">

          <div class="content">
            <h1 class="main-title">Teacher List</h1>

            <table cellspacing="0" cellpadding="0">
              <thead>
                <tr>
                  <th scope="col">Teacher ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Department</th>
                  <th scope="col">Email</th>
                  <th scope="col">subject</th>
                </tr>
              </thead>

              <?php

              $i = 0;
              $tcr_query = mysqli_query($connection, "select * from teachers order by tc_id asc");
              while ($tcr_data = mysqli_fetch_array($tcr_query)) {
                $i++;

              ?>
                <tbody>
                  <tr>
                    <td><?php echo $tcr_data['tc_id']; ?></td>
                    <td><?php echo $tcr_data['tc_name']; ?></td>
                    <td><?php echo $tcr_data['tc_dept']; ?></td>
                    <td><?php echo $tcr_data['tc_email']; ?></td>
                    <td><?php echo $tcr_data['tc_subject']; ?></td>
                  </tr>
                </tbody>

              <?php } ?>

            </table>

          </div>

        </div>

      </div>
    </div>
  </main>
</body>

</html>