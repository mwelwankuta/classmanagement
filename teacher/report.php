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

      <div class="form-div">


        <form method="post">
          <div class="form-child">
            <h1 class="main-title">Individual Report</h1>
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
            <input type="number" name="sr_id">
            <input type="submit" name="sr_btn" value="Go!">
          </div>

        </form>

        <form method="post" action="" class="report-form" style="flex:1;">
          <h2>Mass Report</h2>
          <label>Select Subject</label>
          <select name="subject">
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
          <input type="text" name="date" placeholder="YYYY-MM-DD" value="<?php echo date('Y-m-d') ?>">
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

        $result = mysqli_query($connection, "SELECT * from attendance WHERE `stat_date`='$sdate' and `subject`='$subject' ;");
        // and reports.subject = '$subject' add at the end 
        // error
      }
      if (isset($_POST['sr_date'])) {

      ?>

        <table class="table table-stripped">
          <thead>
            <tr>
              <th scope="col">Exam. No.</th>
              <th scope="col">Name</th>
              <th scope="col">Grade</th>
              <th scope="col">Date</th>
              <th scope="col">Subject</th>
              <th scope="col">Attendance Status</th>
            </tr>
          </thead>


          <?php


          $i = 0;
          while ($row = mysqli_fetch_array($result)) {

            $i++;
          ?>
            <tbody>
              <tr>
                <td><?php echo $row['stat_id']; ?></td>
                <td><?php echo $row['stat_name']; ?></td>
                <td><?php echo $row['stat_grade']; ?></td>
                <td><?php echo $row['stat_date']; ?></td>
                <td><?php
                    switch ($row['subject']) {
                      case 'en':
                        echo "English";
                        break;
                      case 'he':
                        echo "Home Economics";
                        break;
                      case 'intscie':
                        echo "Integrated Science";
                        break;
                      case 'ss':
                        echo "Social Studies";
                        break;
                      case 'bs':
                        echo "Bussiness Studies";
                        break;
                      case 'dt':
                        echo "Design and Technology";
                        break;
                      case 'pe':
                        echo "Physical Education";
                        break;
                      case 'at':
                        echo "Art and Design";
                        break;
                      case 'math':
                        echo "Mathematics";
                        break;
                      default:
                        echo $row['subject'];
                        break;
                    }
                    ?></td>
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
                      <td>Student Name</td>
                      <td><?php echo $data['st_name']; ?></td>
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

  </main>

</body>

</html>