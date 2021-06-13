<?php

ob_start();
session_start();

if ($_SESSION['name'] != 'davy') {

  header('location: ../index.php');
}
?>


<?php

//establishing connection
include('connect.php');


if (isset($_POST['delete'])) {
  $teacherid = $_POST['teacher_id'];

  mysqli_query($connection, "DELETE FROM teachers WHERE `tc_id`='$teacherid' ;");
}

try {

  //validation of empty fields
  if (isset($_POST['signup'])) {

    if (empty($_POST['email'])) {
      throw new Exception("Email cann't be empty.");
    }

    if (empty($_POST['uname'])) {
      throw new Exception("Username cann't be empty.");
    }

    if (empty($_POST['pass'])) {
      throw new Exception("Password cann't be empty.");
    }

    if (empty($_POST['fname'])) {
      throw new Exception("Username cann't be empty.");
    }
    if (empty($_POST['phone'])) {
      throw new Exception("Username cann't be empty.");
    }
    if (empty($_POST['type'])) {
      throw new Exception("Username cann't be empty.");
    }

    //insertion of data to database table admininfo
    $result = mysqli_query($connection, "insert into admininfo(username,password,email,fname,phone,type) values('$_POST[uname]','$_POST[pass]','$_POST[email]','$_POST[fname]','$_POST[phone]','$_POST[type]')");
    $success_msg = "Signup Successfully!";
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
<!-- head ended -->

<!-- body started -->

<body>

  <!-- Menus started-->
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

    <div>
    <h1 class="main-title">All Teachers</h1>
      <table class="table table=stripped table-hover">
        <thead>
          <tr>
            <th scope="col">Teacher ID</th>
            <th scope="col">Name</th>
            <th scope="col">Department</th>
            <th scope="col">Email</th>
            <th scope="col">Subject</th>
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
              <td>
                <form method="post">
                  <input type="hidden" name="teacher_id" value="<?php echo $tcr_data['tc_id'] ?>">
                  <button type="submit" name="delete" style="background-color:red;padding:3px;border:none;color:white; ">Delete</button>
                </form>
              </td>
            </tr>
          </tbody>

        <?php } ?>

      </table>

    </div>


  </main>


</body>

</html>