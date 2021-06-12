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
  <link rel="stylesheet" href="css/main.css">


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


  <div>

    <div class="content">
      <form method="post" action="">
        <h1>Student List</h1>
        <p>Type in the grade </p>
        <div class="students-form">
          <input type="text" name="sr_grade" placeholder="eg. 9">
          <input type="submit" name="sr_btn" class="btn btn-danger" style="border-radius:0%" value="Search">
        </div>
      </form>
      <br>
      <table>
        <thead>
          <tr>
            <th scope="col">Examination No.</th>
            <th scope="col">Name</th>
            <th scope="col">Grade</th>
            <th scope="col">Term</th>
            <th scope="col">Email</th>
          </tr>
        </thead>

        <?php

        if (isset($_POST['sr_btn'])) {

          $srgrade = $_POST['sr_grade'];
          $i = 0;

          $all_query = mysqli_query($connection, "select * from students where students.st_grade = '$srgrade' order by st_id asc ");

          while ($data = mysqli_fetch_array($all_query)) {
            $i++;

        ?>
            <tbody>
              <tr>
                <td><?php echo $data['st_id']; ?></td>
                <td><?php echo $data['st_name']; ?></td>
                <td><?php echo $data['st_grade']; ?></td>
                <td><?php echo $data['st_term']; ?></td>
                <td><?php echo $data['st_email']; ?></td>
              </tr>
            </tbody>

        <?php
          }
        }
        ?>

      </table>

    </div>

  </div>


</body>

</html>