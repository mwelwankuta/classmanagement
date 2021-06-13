<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'davy') {
  header('location: login.php');
}
?>

<?php
include('connect.php');
try {

  if (isset($_POST['att'])) {

    $subject = $_POST['whichsubject'];

    // Error on second Line
    foreach ($_POST['st_status'] as $i => $st_status) {
      $stat_id = $_POST['stat_id'][$i];
      $dp = date('Y-m-d');
      $subject = $_POST['whichsubject'];
      $stat_grade = $_POST['stat_grade'];
      $stat_name = $_POST['stat_name'];
      // Fix this problem
      $stat = mysqli_query($connection, "insert into attendance(stat_id,subject,st_status,stat_date,stat_name, stat_grade) values('$stat_id','$subject','$st_status','$dp', '$stat_name[$i]', '$stat_grade')");

      $att_msg = "Attendance Recorded.";
    }
  }
} catch (Exception $e) {
  $error_msg = $e->$getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Class Management System</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="css/main.css">
  <style type="text/css">
    .status {
      font-size: 10px;
    }
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

    <div>
      <div style="display:flex;" class="date-holder">
        <p style="flex:1;">Attendance of </p>
        <h3><?php echo date('d-m-Y'); ?></h3>
      </div>
      <br>

      <p style="color:green;">
        <?php if (isset($att_msg)) echo $att_msg;
        if (isset($error_msg)) echo $error_msg; ?></p>


      <form method="post" class="auth-holder">
        <div class="form-child">
          <label>Enter Grade</label>
          <input type="text" name="whichgrade" id="input2" placeholder="">
          <input type="submit" style="border-radius:0%" value="Search" name="grade" />
        </div>
      </form>

      <form action="" method="post">

        <div class="form-child">
          <label style="font-size:14px;">Select Subject</label>
          <select name="whichsubject" id="input1">
            <option value="intscie">Integrated Science</option>
            <option value="math">Mathematics</option>
            <option value="bs">Bussiness Studies</option>
            <option value="cs">Computer Studies</option>
            <option value="ss">Social Studies</option>
            <option value="he">Home Economics</option>
            <option value="pe">Physical Education</option>
            <option value="ad">Art and Design</option>
            <option value="dt">Design and Technology</option>
          </select>

        </div>

        <table>
          <thead>
            <tr>
              <th scope="col">Reg. No.</th>
              <th scope="col">Name</th>
              <th scope="col">Grade</th>
              <th scope="col">Term</th>
              <th scope="col">Email</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <?php

          if (isset($_POST['grade'])) {

            $i = 0;
            $radio = 0;
            $grade = $_POST['whichgrade'];
            $all_query = mysqli_query($connection, "select * from students where students.st_grade = '$grade' order by st_id asc");

            while ($data = mysqli_fetch_array($all_query)) {
              $i++;
          ?>

              <body>
                <tr>
                  <td><?php echo $data['st_id']; ?>
                    <input type="hidden" name="stat_id[]" value="<?php echo $data['st_id']; ?>">
                    <input type="hidden" name="stat_name[]" value="<?php echo $data['st_name'] ?>">
                    <input type="hidden" name="stat_grade" value="<?php echo $data['st_grade'] ?>">
                  </td>
                  <td><?php echo $data['st_name']; ?></td>
                  <td><?php echo $data['st_grade']; ?></td>
                  <td><?php echo $data['st_term']; ?></td>
                  <td><?php echo $data['st_adress']; ?></td>

                  <td>
                    <div style="display:flex; flex-direction:column;">
                      <div style="display:flex;">
                        <label style="flex:1;">Present</label>
                        <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Present">
                      </div>

                      <div style="display:flex;">
                        <label style="flex:1;">Absent </label>
                        <input type="radio" name="st_status[<?php echo $radio; ?>]" value="Absent" checked>
                      </div>
                    </div>


                  </td>
                </tr>
              </body>

          <?php

              $radio++;
            }
          }
          ?>
        </table>

        <input type="submit" value="Save!" name="att" />

      </form>
    </div>

  </main>



</body>

</html>