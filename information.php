<!DOCTYPE html>
<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<title>WebMS | Information</title>
</head>
<body>
	<?php 

		include_once 'config.php';

		$_SESSION['message'] = '';


		if (mysqli_connect_errno()) {

			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		
		}

/*
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			print_r($_FILES); die;

			$news_id = $mysqli->real_escape_string($_POST['news_id']);
			$art_title = $mysqli->real_escape_string($_POST['art_title']);
			$art_topic = $mysqli->real_escape_string($_POST['art_topic']);
			$art_content = $mysqli->real_escape_string($_POST['art_content']);
			$author_fname = $mysqli->real_escape_string($_POST['author_fname']);
			$author_lname = $mysqli->real_escape_string($_POST['author_lname']);
			$pub_date = $mysqli->real_escape_string($_POST['pub_date']);
			$art_img_path = $mysqli->real_escape_string($_POST['image/'.$_FILES['avatar']['name']]);
		}

*/
		$sql = 'SELECT * FROM tb_newsinfo';
		$sql2 = 'SELECT * FROM tb_anninfo';
		$result = $mysqli->query($sql);
		$result2 = $mysqli->query($sql2);
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
				<li><a href="information.php" class="s-panel-o-active"><i class="fa fa-book"></i>Information</a></li>
				<li><a href="news.php" class="s-panel-o-i"><i class="fa fa-newspaper-o"></i>Create Article</a></li>
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
		</div>
		<div class="c-panel-i">
			<div class="c-panel-i-h-n c-panel-i-h">
				<h1>News</h1>
			</div>
			<table cellspacing="0">
				<tr>
					<th>ID</th>
					<th>Article Title</th>
					<th>Author</th>
					<th>Date Published</th>
					<th></th>
					<th></th>
				</tr>
				<!--<tr>
					<td>1</td>
					<td>PNR Reach The Top</td>
					<td>Charles Concepcion</td>
					<td>December 29, 2018</td>
					<td><a href="#">Update</a></td>
					<td><a href="#">View</a></td>
				</tr>-->
				<?php
				while($row = mysqli_fetch_array($result))
					{
					echo "<tr>";
					echo "<td>" . $row['id'] . "</td>";
					echo "<td>" . $row['art_title'] . "</td>";
					echo "<td>" . $row['author_fname'] . " " . $row['author_lname'] . "</td>";
					echo "<td>" . $row['pub_date']. "</td>";
					echo "<td><a href="."#"."><i class=".'"fa fa-pencil"'."></i>Update</a></td>";
					echo "<td><a href="."#"."><i class=".'"fa fa-eye"'."></i>View</a></td>";
					echo "</tr>";
					}
					?>
			</table>
		</div>
		<div class="c-panel-ta-page">
			<ul type="none">
				<li><a href="#">&laquo;</a></li>
				<li><a href="#" class="c-panel-ta-page-active">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
		</div>
		<div class="c-panel-i-create">
			<a href="news.php" class="c-panel-i-n-create">Create New</a>
		</div>
		<div class="c-panel-i c-panel-i-a">
			<div class="c-panel-i-h-a c-panel-i-h">
				<h1>Announcement</h1>
			</div>
			<table cellspacing="0">
				<tr>
					<th>ID</th>
					<th>Creator Name</th>
					<th>Message</th>
					<th>Date Published</th>
					<th></th>
					<th></th>
				</tr>
				<!--<tr>
					<td>1</td>
					<td>Viewing of System</td>
					<td>January 5, 2019</td>
					<td>December 29, 2018</td>
					<td><a href="#">Update</a></td>
					<td><a href="#">View</a></td>
				</tr>-->
				<?php
				while($row2 = mysqli_fetch_array($result2))
					{
					echo "<tr>";
					echo "<td>" . $row2['ann_id'] . "</td>";
					echo "<td>" . $row2['creator_fname'] . " " . $row2['creator_lname'] . "</td>";
					echo "<td>" . mb_strimwidth($row2['message'], 0, 100, "...") . "</p>";
					echo "<td>" . $row2['pub_date']. "</td>";
					echo "<td><a href="."#"."><i class=".'"fa fa-pencil"'."></i>Update</a></td>";
					echo "<td><a href="."#"."><i class=".'"fa fa-eye"'."></i>View</a></td>";
					echo "</tr>";
					}
					?>
			</table>
		</div>
		<div class="c-panel-ta-page">
			<ul type="none">
				<li><a href="#">&laquo;</a></li>
				<li><a href="#" class="c-panel-ta-page-active">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#">&raquo;</a></li>
			</ul>
		</div>
		<div class="c-panel-i-create">
			<a href="announcement.php" class="c-panel-i-a-create">Create New</a>
		</div>
	</div>
</body>
</html>