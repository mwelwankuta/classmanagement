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
  <title>Students </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="css/main.css">
  </style>

</head>

<body>

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

    <div class="content">
      <form method="post">
        <div class="form-child">
          <h1 class="main-title">Student List</h1>
          <label>Type in the grade </label>
          <input type="text" name="sr_grade">
          <input type="submit" name="sr_btn" style="border-radius:0%" value="Search">
        </div>
      </form>
      <br>
      <form>
        <table>
          <thead>
            <tr>
              <th scope="col">Examination No.</th>
              <th scope="col">Name</th>
              <th scope="col">Grade</th>
              <th scope="col">Term</th>
              <th scope="col">Address</th>
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
                  <td><h1><!-- to make tables bigger--></h1> <?php echo $data['st_address']; ?> <h1><!-- to make tables bigger--></h1></td>
                </tr>
              </tbody>

          <?php
            }
          }
          ?>

        </table>
      </form>
    </div>

  </main>


</body>

</html>