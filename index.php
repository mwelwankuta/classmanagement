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
	<title>CMS | Login</title>
	<link rel="stylesheet" href="css/auth.css">
</head>

<body class="container">

	<div>
		<div>

			<form method="post">
				<div class="form-child">
					<h1 class="main-title">Sign in to Class Management</h1>

					<p class="error_msg">
						<?php
						if (isset($error_msg)) {
							echo $error_msg;
						}
						?>
					</p>

					<div class="login-input-holder">
						<label for="input1">Username</label>
						<input type="text" name="username" id="input1" />

						<label for="input2">Password</label>
						<input type="password" name="password" id="input2" />

						<!-- Login Button  -->
						<input type="submit" value="Login" name="login" class="submit-button" />
					</div>


					<div class="login-type">
						<label>Login As:</label>
						<div class="login-type-child">
							<label>
								<input type="radio" name="type" id="optionsRadios1" value="teacher" checked> Teacher
							</label>
							<label>
								<input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
							</label>
						</div>
					</div>

					<div class="auth-holder">
						<p>New to Class Management? <a href="signup.php">Create New Account</a></p>
					</div>
				</div>
			</form>
		</div>
	</div>

</body>

</html>