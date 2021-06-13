<?php

include('connect.php');

try {

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

    $result = mysqli_query($connection, "insert into admininfo(username,password,email,fname,phone,type) values('$_POST[uname]','$_POST[pass]','$_POST[email]','$_POST[fname]','$_POST[phone]','$_POST[type]')");
    $success_msg = "Signup Successfully!";
  }
} catch (Exception $e) {
  $error_msg = $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Class Management System</title>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="css/auth.css">

</head>

<body class="container">


  <div>

    <div>



      <form method="post">
        <div class="form-child">
          <h1 class="main-title">Signup</h1>
          <p class="success_msg"> <?php
              if (isset($success_msg)) echo $success_msg;
              if (isset($error_msg)) echo $error_msg;
              ?></p>
          <div class="login-input-holder">
            <label for="fname">Full Name</label>
            <input type="text" name="fname" id="input1" required />

            <label for="phone">Phone Number</label>
            <input type="number" name="phone" id="input1" required />

            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="input1" required />

            <label for="uname">Username</label>
            <input type="text" name="uname" id="input1" required />

            <label for="pass">Password</label>
            <input type="password" name="pass" id=" input2" required />

            <!-- SignUp Button -->
            <input type="submit" value="Signup" name="signup" />
          </div>


          <div class="login-type">
            <label>User Role:</label>
            <div class="login-type-child">
              <label>
                <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
              </label>
              <label>
                <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
              </label>
            </div>
          </div>


          <div class="auth-holder">
          <p style="font-size:16px;">Already have an account? <a href="index.php">Login</a> here.</p>
          </div>
        </div>
      </form>
    </div>



  </div>

</body>

</html>