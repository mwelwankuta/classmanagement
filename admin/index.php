<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'davy') {

  header('location: ../index.php');
}
?>

<?php

include('connect.php');

//data insertion
try {

  //checking if the data comes from students form
  if (isset($_POST['std'])) {

    //students data insertion to database table "students"
    $result = mysqli_query($connection, "INSERT into students(st_id,st_name, st_grade, st_term, st_address) values('$_POST[st_id]','$_POST[st_name]','$_POST[st_grade]','$_POST[st_term]','$_POST[st_address]')");
    $success_msg = "Student added successfully.";
  }

  //checking if the data comes from teachers form
  if (isset($_POST['tcr'])) {

    //teachers data insertion to the database table "teachers"
    $res = mysqli_query($connection, "INSERT into teachers(tc_id,tc_name,tc_dept,tc_email,tc_subject) values('$_POST[tc_id]','$_POST[tc_name]','$_POST[tc_dept]','$_POST[tc_email]','$_POST[tc_subject]')");
    $success_msg = "Teacher added successfully.";
  }
} catch (Exception $e) {
  $error_msg = $e->getMessage();
}

?>



<!DOCTYPE html>
<html lang="en">
<!-- head started -->

<head>
  <title>Class Management System</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">

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
        <a href="v-students.php">
          <div><img src="https://img.icons8.com/material/24/ffffff/student-registration.png" /></div>
          <p>Students</p>
        </a>
        <a href="v-teachers.php">
          <div><img src="https://img.icons8.com/material/24/ffffff/group-foreground-selected.png" /></div>
          <p>Teachers</p>
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
    <p class="error_msg">
      <?php if (isset($success_msg)) echo $success_msg;
      if (isset($error_msg)) echo $error_msg; ?>
    </p>

    <div class="content">
      <div class="row" id="student">
        <form method="post">
          <h4>Add Student's Information</h4>
          <div class="form-child">
            <label for="st_id">Exam. No.</label>
            <input type="number" name="st_id" class="form-control" id="input1" />

            <label for="st_name">Name</label>
            <input type="text" name="st_name" class="form-control" id="input1" />

            <label for="st_grade">grade</label>
            <input type="text" name="st_grade" class="form-control" id="input1" />

            <label for="st_term">Term</label>
            <input type="text" name="st_term" class="form-control" id="input1" />

            <label for="st_address">Address</label>
            <input type="text" name="st_address" class="form-control" id="input1" />

          </div>

          <input type="submit" value="Add Student" name="std" />
        </form>
      </div>

      <div id="teacher">
        <form method="post">
          <h4 class="main-title">Add Teacher's Information</h4>
          <div class="form-holder">
            <label for="tc_id">Teacher ID</label>
            <div class="form-child">
              <input type="text" name="tc_id" />

              <label for="tc_name">Name</label>
              <input type="text" name="tc_name" />

              <label for="tc_dept">Department</label>
              <input type="text" name="tc_dept" />

              <label for="tc_email">Email</label>
              <input type="email" name="tc_email" />

              <label for="tc_subject">Subject Name</label>
              <input type="text" name="tc_subject" />
            </div>

            <input type="submit" value="Add Teacher" name="tcr" />
        </form>

      </div>


    </div><br>
    <!-- Contents, Tables, Forms, Images ended -->

    </center>
  </main>
</body>
<!-- Body ended  -->

</html>