<!DOCTYPE html>
<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<title>WebMS | The Developers</title>
</head>
<body>
	<?php
		include_once 'config.php';

		if (isset($_SESSION['user_id'])) {	
		}
		else {
			session_destroy();
			header("location: error.php");
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
				<li><a href="news.php" class="s-panel-o-i"><i class="fa fa-newspaper-o"></i>Create Article</a></li>
				<li><a href="announcement.php" class="s-panel-o-i"><i class="fa fa-bullhorn"></i>Create Event</a></li>
				<li><a href="train-arrival.php"><i class="fa fa-train"></i>Train Arrival</a></li>
				<li><a href="feedback.php"><i class="fa fa-comments"></i>User Feedback</a></li>
			</ul>
			<p>PERSONAL INFORMATION OPTIONS</p>
			<ul type="none">
				<li><a href="background.php"><i class="fa fa-globe"></i>Company Background</a></li>
				<li><a href="developers.php" class="s-panel-o-active"><i class="fa fa-group"></i>The Developers</a></li>
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
		</div>
	</div>
</body>
</html>