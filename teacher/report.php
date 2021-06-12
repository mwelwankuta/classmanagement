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

      <div class="form-div">


        <form method="post" action="" class="report-form" style="flex: 1;">
          <h1>Individual Report</h1>
          <label>Select Subject</label>
          <select name="whichsubject">
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

          <label>Student Reg. No.</label>
          <input type="text" name="sr_id">
          <input type="submit" name="sr_btn" value="Go!">

        </form>

        <form method="post" action="" class="report-form" style="flex:1;">
          <h2>Mass Report</h2>
          <label>Select Subject</label>
          <select name="cource">
            <option value="eng">English</option>
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
          <p> </p>
          <label>Date</label>
          <input type="text" name="date" placeholder="YYYY-MM-DD">
          <input type="submit" name="sr_date" value="Go!">
        </form>
      </div>

      <?php

      if (isset($_POST['sr_btn'])) {

        $sr_id = $_POST['sr_id'];
        $subject = $_POST['whichsubject'];

        $single = mysqli_query($connection, "SELECT stat_id,count(*) as countP from attendance where attendance.stat_id='$sr_id' and attendance.subject = '$subject' and attendance.st_status='Present'");
        $singleT = mysqli_query($connection, "select count(*) as countT from attendance where attendance.stat_id='$sr_id' and attendance.subject = '$subject'");
      }

      if (isset($_POST['sr_date'])) {

        $sdate = $_POST['date'];
        $subject = $_POST['subject'];

        $result = mysqli_query($connection, "SELECT * from attendance WHERE stat_date='$sdate'");
        // and reports.subject = '$subject' add at the end 
        // error
      }
      if (isset($_POST['sr_date'])) {

      ?>

        <table class="table table-stripped">
          <thead>
            <tr>
              <th scope="col">Reg. No.</th>
              <th scope="col">Name</th>
              <th scope="col">Department</th>
              <th scope="col">Grade</th>
              <th scope="col">Date</th>
              <th scope="col">Attendance Status</th>
            </tr>
          </thead>


          <?php


          $i = 0;
          while ($data = mysqli_fetch_array($result)) {

            $i++;
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['st_id']; ?></td>
                <td><?php echo $row['st_name']; ?></td>
                <td><?php echo $row['st_dept']; ?></td>
                <td><?php echo $row['st_grade']; ?></td>
                <td><?php echo $row['stat_date']; ?></td>
                <td><?php echo $row['st_status']; ?></td>
              </tr>
            </tbody>

        <?php
          }
        }
        ?>

        </table>


        <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
          <table class="table table-striped">

            <?php


            if (isset($_POST['sr_btn'])) {

              $count_pre = 0;
              $i = 0;
              $count_tot;
              if ($row = mysqli_fetch_row($singleT)) {
                $count_tot = $row[0];
              }
              while ($data = mysqli_fetch_array($single)) {
                $i++;

                if ($i <= 1) {
            ?>

                  <tbody>
                    <tr>
                      <td>Student Reg. No: </td>
                      <td><?php echo $data['stat_id']; ?></td>
                    </tr>

                    <tr>
                      <td>Total Class (Days): </td>
                      <td><?php echo $count_tot; ?> </td>
                    </tr>

                    <tr>
                      <td>Present (Days): </td>
                      <td><?php echo $data[1]; ?> </td>
                    </tr>

                    <tr>
                      <td>Absent (Days): </td>
                      <td><?php echo $count_tot -  $data[1]; ?> </td>
                    </tr>

                  </tbody>

            <?php

                }
              }
            }
            ?>
          </table>
        </form>

    </div>

  </div>

</body>

</html>