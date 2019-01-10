 <!DOCTYPE HTML>
<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
	<title>WebMS | Signup</title>
</head>
<body>
	 <?php
	
		include_once 'config.php';

		$_SESSION['message'] = '';
		$_SESSION['border'] = 'style="border: none;"';

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$_SESSION['username'] = $_POST['username'];
			$_SESSION['fname'] = $_POST['fname'];
			$_SESSION['lname'] = $_POST['lname'];

			$fname = $mysqli->real_escape_string($_POST['fname']);
			$lname = $mysqli->real_escape_string($_POST['lname']);
			$username = $mysqli->real_escape_string($_POST['username']);
			$email = $mysqli->real_escape_string($_POST['email']);
			$gender = $mysqli->real_escape_string($_POST['gender']);
			$password = $mysqli->real_escape_string(md5($_POST['password']));
			$user_img = $mysqli->real_escape_string('user_images/'.$_FILES['user_img']['name']);

			if ($_POST['password'] == $_POST['cpassword']) {

				if (preg_match("!image!", $_FILES['user_img']['type'])) {
					
					if (copy($_FILES['user_img']['tmp_name'], $user_img)) {

						$_SESSION['username'] = $username;
						$_SESSION['fname'] = $fname;
						$_SESSION['lname'] = $lname;
						$_SESSION['user_img'] = $user_img;
						$_SESSION['gender'] = $gender;

						$sql = "INSERT INTO tb_paccounts (fname, lname, gender, username, email, pwd, user_img_path) "
						. "VALUES ('$fname','$lname', '$gender','$username','$email','$password','$user_img')";

						if ($mysqli->query($sql) === true) {
							$_SESSION['message'] = '<p class="signup-message-good">You have successfully registered!</p>';
							header("refresh: 2; url=index.php");
						}
						else {
							$_SESSION['message'] = '<p class="signup-message-bad">Unable to register account!</p>';
						}
					}
					else {
						$_SESSION['message'] = '<p class="signup-message-bad">File upload failed. Try again!</p>';
					}
				}
				else {
					$_SESSION['message'] = '<p class="signup-message-bad">Please only upload GIF, JPG or PNG images!</p>';
				}
			}
			else {
				$_SESSION['message'] = '<p class="signup-message-bad">Two password do not match!</p>';
				$_SESSION['border'] = 'style="border: 1px solid #a00;"';
			}
		}
	?>
	<div class="signup-bg">
		<div class="signup-header">
			<a href="index.php">Sign In</a>
		</div>
		<h1>Web<span>MS</span></h1>
		<p>Manage you life. Manage you service.</p>
		<div class="signup-message">
			<?= $_SESSION['message'] ?>
		</div>
		<div class="signup-holder">
			<form action="signup.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<label>First Name:</label>
				<input type="text" name="fname" required />
				<label>Last Name:</label>
				<input type="text" name="lname" required />
				<label>Username:</label>
				<input type="text" name="username" required />
				<label>Email:</label>
				<input type="text" name="email" required />
				<label>Password:</label>
				<input type="password" name="password" <?= $_SESSION['border'] ?> required />
				<label>Confirm Password:</label>
				<input type="password" name="cpassword" <?= $_SESSION['border'] ?> required />
				<label>Select Gender:</label>
				<select name="gender">
					<option value="Male" >Male</option>
					<option value="Female" >Female</option>
				</select>
				<label>Select Your Profile Picture:
				<input type="file" name="user_img" required /></label>
				<input type="submit" value="Register">
			</form>
		</div>
		<footer>
			<p>® All Rights Reserved 2019</p>
			<p>Created By: Charles Concepcion</p>
		</footer>
	</div>
</body>
</html>