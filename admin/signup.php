<?php

ob_start();
session_start();

if($_SESSION['name']!='davy')
{

  header('location: ../index.php');
}
?>


<?php

//establishing connection
include('connect.php');

  try{

    //validation of empty fields
      if(isset($_POST['signup'])){

        if(empty($_POST['email'])){
          throw new Exception("Email cann't be empty.");
        }

          if(empty($_POST['uname'])){
             throw new Exception("Username cann't be empty.");
          }

            if(empty($_POST['pass'])){
               throw new Exception("Password cann't be empty.");
            }
              
              if(empty($_POST['fname'])){
                 throw new Exception("Username cann't be empty.");
              }
                if(empty($_POST['phone'])){
                   throw new Exception("Username cann't be empty.");
                }
                  if(empty($_POST['type'])){
                     throw new Exception("Username cann't be empty.");
                  }

        //insertion of data to database table admininfo
        $result = mysqli_query($connection,"insert into admininfo(username,password,email,fname,phone,type) values('$_POST[uname]','$_POST[pass]','$_POST[email]','$_POST[fname]','$_POST[phone]','$_POST[type]')");
        $success_msg="Signup Successfully!";

  
  }
}
  catch(Exception $e){
    $error_msg =$e->getMessage();
  }

?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Class Management System</title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css <?php echo time() ?>">

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

    <!-- Menus ended -->

<center>
<h1>Create User</h1>
<p>    <?php
    if(isset($success_msg)) echo $success_msg;
    if(isset($error_msg)) echo $error_msg;
     ?>
       
     </p>
     <br>
<div class="content">

  <div class="row">
   
    <form method="post" class="form-horizontal col-md-6 col-md-offset-3">

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-7">
            <input type="text" name="email"  class="form-control" id="input1" placeholder="your email" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Username</label>
          <div class="col-sm-7">
            <input type="text" name="uname"  class="form-control" id="input1" placeholder="choose username" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-7">
            <input type="password" name="pass"  class="form-control" id="input1" placeholder="choose a strong password" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Full Name</label>
          <div class="col-sm-7">
            <input type="text" name="fname"  class="form-control" id="input1" placeholder="your full name" />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Phone Number</label>
          <div class="col-sm-7">
            <input type="text" name="phone"  class="form-control" id="input1" placeholder="your phone number" />
          </div>
      </div>


      <div class="form-group" class="radio">
      <label for="input1" class="col-sm-3 control-label">Role</label>
      <div class="col-sm-7">
        <label>
          <input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
        </label>
            <label>
          <input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
        </label>
        <label>
          <input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
        </label>
      </div>
      </div>

      <input type="submit" class="btn btn-primary col-md-2 col-md-offset-8" value="Signup" name="signup" />
    </form>
  </div>
    

</div>

</center>

</body>
<!-- Body ended  -->

</html>
