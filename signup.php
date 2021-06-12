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

  <link rel="stylesheet" type="text/css" href="css/main.css">

  <link rel="stylesheet" href="css/signup.css">

</head>

<body>

  <header>

    <h1 id="title">Class Management System</h1>

  </header>

  <div class="content">

    <div class="row">
      <?php
      if (isset($success_msg)) echo $success_msg;
      if (isset($error_msg)) echo $error_msg;
      ?>


      <form method="post">
        <h1>Signup</h1>
        <div style="display:flex; flex-direction:column">
          <label for="input1">Full Name</label>
          <input type="text" name="fname" class="form-control" id="input1" placeholder="Fullname" required />

        </div>

        <div style="display:flex; flex-direction:column">
          <label for="input1">Phone Number</label>

          <input type="number" name="phone" class="form-control" id="input1" placeholder="Phone Number" required />

        </div>

        <div style="display:flex; flex-direction:column">
          <label for="input1">Email</label>

          <input type="email" name="email" class="form-control" id="input1" placeholder="Your Email" required />

        </div>

        <div style="display:flex; flex-direction:column">
          <label for="input1">Username</label>
            <input type="text" name="uname" id="input1" placeholder="Choose Username" required />
        </div>

        <div style="display:flex; flex-direction:column">
          <label for="input1" ">Password</label>
            <input type="password" name="pass" " id=" input1" placeholder="Enter Password" required />
        </div>


        <div class="radio">
          <label for="input1">User Role:</label>
          <div>
            <label>
              <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
            </label>
            <label>
              <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
            </label>
          </div>
        </div>

        <input type="submit" style="border-radius:0%" class="btn btn-primary col-md-2 col-md-offset-8" value="Signup" name="signup" />
        <p style="font-size:16px;">Already have an account? <a href="index.php">Login</a> here.</p>
      </form>
    </div>



  </div>

</body>

</html>