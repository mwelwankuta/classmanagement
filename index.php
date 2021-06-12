<?php

if (isset($_POST['login'])) {
	//start of try block

	try {

		//checking empty fields
		if (empty($_POST['username'])) {
			throw new Exception("Username is required!");
		}
		if (empty($_POST['password'])) {
			throw new Exception("Password is required!");
		}
		//establishing connection with db and things
		include('connect.php');

		//checking login info into database
		$row = 0;
		$sql = "SELECT * from admininfo where username='$_POST[username]' and password='$_POST[password]' and type='$_POST[type]'";
		$result = mysqli_query($connection, $sql);

		$row = mysqli_num_rows($result);

		if ($row > 0 && $_POST["type"] == 'teacher') {
			session_start();
			$_SESSION['name'] = "davy";
			header('location: teacher/index.php');
		} else if ($row > 0 && $_POST["type"] == 'admin') {
			session_start();
			$_SESSION['name'] = "davy";
			header('location: admin/index.php');
		} else {
			session_start();
			$_SESSION['name'] = "davy";
			header('location: teacher/index.php');

			// throw new Exception("Username,Password or Role is wrong, try again!");

			// header('location: login.php');
		}
	}

	//end of try block
	catch (Exception $e) {
		$error_msg = $e->getMessage();
	}
	//end of try-catch
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Class Management System</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" href="css/login.css">
</head>

<body class="container">

	<header>

		<h1 id="title">Class Management System</h1>

	</header>

	<div class="content">
		<div>

			<form method="post">
				<h1>Login</h1>

				<?php
				//printing error message
				if (isset($error_msg)) {
					echo "<p style='color:red;'>" . $error_msg . "</p>";
				}
				?>


				<div style="display:flex; flex-direction:column">
					<label for="input1" class="col-sm-3 control-label">Username</label>

					<input type="text" name="username" class="form-control" id="input1" placeholder="Your Username" />

				</div>

				<div style="display:flex; flex-direction:column">
					<label for="input1" class="col-sm-3 control-label">Password</label>

					<input type="password" name="password" id="input1" placeholder="Your Password" />

				</div>


				<div class="radio">
					<label for="input1">Login As:</label>
					<div class="col-sm-6">
						<label>
							<input type="radio" name="type" id="optionsRadios1" value="teacher" checked> Teacher
						</label>
						<label>
							<input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
						</label>
					</div>
				</div>

				<input type="submit" style="border-radius:0%" value="Login" name="login" />

				<div class="links">
					<a href="signup.php">Create New Account</a>
				</div>
			</form>
		</div>
	</div>

</body>

</html>