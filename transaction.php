<!DOCTYPE html>
<html>
<head>
	<link href="style.css" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<title>WebMS | Transaction</title>
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

		$_SESSION['message'] = '';

		$monthNum = date("m");
		$monthName = date('F',mktime(0,0,0,$monthNum, 10));

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {

			$ticket_start = $mysqli->real_escape_string($_POST['ticket_start']);
			$ticket_end = $mysqli->real_escape_string($_POST['ticket_end']);
			$ticket_quantity = (int) $mysqli->real_escape_string($_POST['ticket_quantity']);
			$date_released = $monthNum . " " . date("d") . ", " . date("Y");

			$sql = "SELECT * FROM tb_tickets WHERE ticket_start='$ticket_start' AND ticket_end='$ticket_end'";
			$result = $mysqli->query($sql);
			$row = $result->fetch_assoc();

			$_SESSION['total'] = $ticket_quantity * $row['ticket_price'];
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
				<li><a href="transaction.php" class="s-panel-o-active"><i class="fa fa-credit-card"></i>Transactions</a></li>
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
		<div class="c-panel-t">
			<div class="c-panel-t-h">
				<h1>Transaction Form</h1>
			</div>
			<form action="transaction.php" method="post" enctype="multipart/form-data" autocomplete="off">
				<label>Start Station:</label>
				<select name="ticket_start" required >
					<option value="Tutuban">Tutuban</option>
					<option value="Blumentritt">Blumentritt</option>
					<option value="Laon-Laan">Laon-Laan</option>
					<option value="Espana">Espana</option>
					<option value="Sta. Mesa">Sta. Mesa</option>
					<option value="Pandacan">Pandacan</option>
					<option value="Paco">Paco</option>
					<option value="San Andres">San Andres</option>
					<option value="Vito Cruz">Vito Cruz</option>
					<option value="Buendia">Buendia</option>
					<option value="Pasay Road">Pasay Road</option>
					<option value="EDSA">EDSA</option>
					<option value="Nichols">Nichols</option>
					<option value="FTI">FTI</option>
					<option value="Bicutan">Bicutan</option>
					<option value="Sucat">Sucat</option>
					<option value="Alabang">Alabang</option>
				</select>
				<label>End Station:</label>
				<select name="ticket_end" required >
					<option value="Tutuban">Tutuban</option>
					<option value="Blumentritt">Blumentritt</option>
					<option value="Laon-Laan">Laon-Laan</option>
					<option value="Espana">Espana</option>
					<option value="Sta. Mesa">Sta. Mesa</option>
					<option value="Pandacan">Pandacan</option>
					<option value="Paco">Paco</option>
					<option value="San Andres">San Andres</option>
					<option value="Vito Cruz">Vito Cruz</option>
					<option value="Buendia">Buendia</option>
					<option value="Pasay Road">Pasay Road</option>
					<option value="EDSA">EDSA</option>
					<option value="Nichols">Nichols</option>
					<option value="FTI">FTI</option>
					<option value="Bicutan">Bicutan</option>
					<option value="Sucat">Sucat</option>
					<option value="Alabang">Alabang</option>
				</select>
				<label>Quantity:</label>
				<input type="text" name="ticket_quantity" />
				<input type="submit" value="Process Order" />
			</form>
		</div>
		<div class="c-panel-t-reciept">
			<div class="c-panel-t-reciept-h">
				<h1>Transaction Details</h1>
			</div>
			<p>Total Fare Ticket</p>
			<h4>₱ <?= $_SESSION['total'] ?></h4>
			<h3>Subtotal:</h3>
			<h2>₱ <?= $row['ticket_price']. " x ". $ticket_quantity ?> <span><?= $ticket_start. " to " .$ticket_end ?></span><a href="#">Cancel</a></h2>
		</div>
		<div class="c-panel-t-history">
			<div class="c-panel-t-history-h">
				<h1>Transaction History</h1>
			</div>
			<table cellspacing="0">
				<tr>
					<th>ID</th>
					<th>Ticket Start</th>
					<th>Ticket End</th>
					<th>Ticket Price</th>
					<th>Date Released</th>
				</tr>
				<tr>
					<td>1</td>
					<td>Tutuban</td>
					<td>Espana</td>
					<td>30.00</td>
					<td>February 20, 2029</td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>