<!DOCTYPE html>
<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<title>WebMS | Dashboard</title>
</head>
<body>

	<?php

		include_once 'config.php';

		$_SESSION['message'] = '';

		$monthNum = date("m");
		$monthName = date('F',mktime(0,0,0,$monthNum, 10));

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$art_title = $mysqli->real_escape_string($_POST['art_title']);
		$art_content = $mysqli->real_escape_string($_POST['art_content']);
		$author_fname = $mysqli->real_escape_string($_POST['author_fname']);
		$author_lname = $mysqli->real_escape_string($_POST['author_lname']);
		$pub_date = $monthName . " " . date("d") . ", " . date("Y");
		$art_img_path = $mysqli->real_escape_string('news_images/'.$_FILES['art_img']['name']);


		if (preg_match("!image!", $_FILES['art_img']['type'])) {

			if (copy($_FILES['art_img']['tmp_name'], $art_img_path)) {

				$_SESSION['art_img'] = $art_img_path;

				$sql = "INSERT INTO tb_newsinfo (art_title, author_fname, author_lname, art_content, pub_date, art_img_path) "
				. "VALUES ('$art_title','$author_fname','$author_lname', '$art_content', '$pub_date','$art_img_path')";

				if ($mysqli->query($sql) === true) {
					$_SESSION['message'] = '<p class="c-panel-n-message-good">Record has been saved</p>';
					header("refresh: 2; url=information.php");
				}
				else {
					$_SESSION['message'] = '<p class="c-panel-n-message-bad">Record not saved! Please try again</p>';
				}
			}
			else {
				$_SESSION['message'] = '<p class="c-panel-n-message-bad">File Upload Failed!</p>';
			}
		}
		else {
			$_SESSION['message'] = '<p class="c-panel-n-message-bad">Please upload JPG, PNG and GIF images</p>';
		}
	}
	?>
	<!--Eskriptong Para sa Pangyayari at Animasyon-->
	<script type="text/javascript" src="main.js">
	</script>

	<!--Unang Kabanata-->
	<div id="sidebar" class="s-panel">
		<div class="s-panel-p">
			<img <?php echo 'src="'.$_SESSION['user_img'].'"' ?> />
			<h4><?= $_SESSION['fname']. " " .$_SESSION['lname'] ?></h4>
			<?php

			if($_SESSION['gender'] == 'Male') {
				echo '<p class="gender-boy">@'.$_SESSION['username']. '</p>';
			}
			else {
				echo '<p class="gender-girl>@'.$_SESSION['username']. '</p>';
			}
			?>
		</div>
		<div class="s-panel-o">
			<ul type="none">
				<li><a href="dashboard.php"><i class="fa fa-home"></i>Dashboard</a></li>
			</ul>
			<p>POINT OF SALE OPTIONS</p>
			<ul type="none">
				<li><a href="transaction.php"><i class="fa fa-credit-card"></i>Transactions</a></li>
				<li><a href="inventory.php"><i class="fa fa-archive"></i>Ticket Inventory</a></li>
				<li><a href="sales-monitoring.php"><i class="fa fa-bar-chart"></i>Sales Monitoring</a></li>
			</ul>
			<p>INFORMATION GATHERING OPTIONS</p>
			<ul type="none">
				<li><a href="information.php"><i class="fa fa-book"></i>Information</a></li>
				<li><a href="news.php" class="s-panel-o-i s-panel-o-active"><i class="fa fa-newspaper-o"></i>Create Article</a></li>
				<li><a href="announcement.php" class="s-panel-o-i"><i class="fa fa-bullhorn"></i>Create Event</a></li>
				<li><a href="train-arrival.php"><i class="fa fa-train"></i>Train Arrival</a></li>
				<li><a href="feedback.php"><i class="fa fa-comments"></i>User Feedback</a></li>
			</ul>
			<p>PERSONAL INFORMATION OPTIONS</p>
			<ul type="none">
				<li><a href="background.php"><i class="fa fa-globe"></i>Company Background</a></li>
				<li><a href="developers.php"><i class="fa fa-group"></i>The Developers</a></li>
			</ul>
		</div>
	</div>
	<div id="content" class="c-panel">
		<div class="c-panel-h">
			<div class="c-panel-h-mi">
				<img src="img/menu-icon-white.png" id="menu-icon" onclick="rotateMenuIcon()" />
			</div>
			<h1>Web<span>MS</span></h1>
			<ul type="none">
				<li><a href="logout.php" class="c-panel-h-a-notif"><i class="fa fa-user"></i> Logout</a></li>
				<li><a href="#" class="c-panel-h-a-notif"><i class="fa fa-bell"></i> Notification</a></li>
				<li><a href="#" class="c-panel-h-a-notif"><i class="fa fa-comment"></i> Conversation</a></li>
			</ul>
			<div class="c-panel-n-message">
				<?= $_SESSION['message'] ?>
			</div>
			<div class="c-panel-n">
				<div class="c-panel-n-h">
					<h1>Create New Article</h1>
				</div>
				<form action="news.php" method="post" enctype="multipart/form-data" autocomplete="off">
					<label>Article Title:</label>
					<input type="text" class="c-panel-n-title" name="art_title" required />
					<label>Author's First Name:</label>
					<input type="text" name="author_fname" required />
					<label>Author's Last Name:</label>
					<input type="text" name="author_lname" required />
					<label>Date Published:</label>
					<select disabled="disabled">
						<option><?php echo date("M") ?></option>
					</select>
					<select disabled="disabled">
						<option><?php echo date("d") ?></option>
					</select>
					<select disabled="disabled">
						<option><?php echo date("Y") ?></option>
					</select>
					<label>Content:</label>
					<textarea name="art_content" required ></textarea>
					<input type="file" name="art_img" required />
					<input type="submit" value="Save Record" />
				</form>
			</div>
		</div>
	</div>
</body>
</html>