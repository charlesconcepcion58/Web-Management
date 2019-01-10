<!DOCTYPE HTML>
<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
	<title>WebMS | Login</title>
</head>
<body>
	<?php
		include_once 'config.php';

		$_SESSION['message'] = '';

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$username = $mysqli->real_escape_string($_POST['username']);
			$result = $mysqli->query("SELECT * FROM tb_paccounts WHERE username='$username'");

			if ($result->num_rows == 0) {
				$_SESSION['message'] = '<p class="login-message-bad">Username does not exist!</p>';
			}
			else {
				$user = $result->fetch_assoc();

				if (md5($_POST['password']) == $user['pwd']) {

					$_SESSION['username'] = $user['username'];
					$_SESSION['fname'] = $user['fname'];
					$_SESSION['lname'] = $user['lname'];
					$_SESSION['user_id'] = $user['user_id'];
					$_SESSION['user_img'] = $user['user_img_path'];
					$_SESSION['gender'] = $user['gender'];

					$_SESSION['logged_in'] = true;

					$_SESSION['message'] = '<p class="login-message-good">Logged In Successfully, Redirecting...</p>';

					header("refresh: 2; url=dashboard.php");
				}
				else {
					$_SESSION['message'] = '<p class="login-message-bad">You have entered a wronng password, Please try again!</p>';
				}
			}
		}
	?>
	<div class="login-bg">
		<div class="login-header">
			<a href="signup.php">Signup</a>
		</div>
		<h1>Web<span>MS</span></h1>
		<p>Manage your Life. Manage your Service.</p>
		<div class="login-message">
			<?= $_SESSION['message'] ?>
		</div>
		<div class="login-holder">
			<form action="index.php" method="post" enctype="multiform/form-data" autocomplete="off">
				<label>Username:</label>
				<input type="text" name="username" required />
				<label>Password:</label>
				<input type="password" name="password" required />
				<input type="submit" value="Sign In" />
			</form>
		</div>
		<footer>
			<p>® All Rights Reserved 2019</p>
			<p>Created By: Charles Concepcion</p>
		</footer>
	</div>
</body>