<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'davy') {
  header('location: login.php');
}
?>
<?php include('connect.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Class Management System</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="css/main.css">

  <link rel="stylesheet" href="styles.css">

  </style>

</head>

<body>

  <header>
    <h1 id="title">Class Management System</h1>
    <div class="navbar">
      <a href="index.php">Home</a>
      <a href="students.php">Students</a>
      <a href="teachers.php">Teachers</a>
      <a href="attendance.php">Attendance</a>
      <a href="report.php" style="flex:1;">Report</a>
      <a href="../logout.php" id="logout">Logout</a>
    </div>

  </header>

  <div class="row">

    <div class="content">
    <h1>Teacher List</h1>

      <table class="table table=stripped">
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

</body>

</html>