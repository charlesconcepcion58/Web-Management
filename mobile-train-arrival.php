<!DOCTYPE HTML>
<html>
<head>
	<title>sample</title>
</head>
<body>
<?php
	
	include_once 'config.php';

	$_SESSION['message'] = '';
	$_SESSION['time_add'] = 0;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		$station_name = $mysqli->real_escape_string($_POST['station_name']);

		$sql = "SELECT * FROM tb_stations WHERE station_name='$station_name'";

		$result = $mysqli->query($sql);

		$arrival = $result->fetch_assoc();

		$station_distance = $arrival['station_distance'];
		
		$train_speed = 24.24;

		$time_add = floor(($station_distance / $train_speed)*60);

		$_SESSION['time_add'] = $time_add;
		$time_in = new DateTime('07:00am');
		$time_in->add(new DateInterval('PT'.$time_add.'M'));

		$stamp = $time_in->format('h:ia');

		$_SESSION['time_end'] = $stamp;
	}
	

?>
<p>Train will arrive in: <?= $_SESSION['time_end'] ?></p>
<form action="mobile-train-arrival.php" method="post">
<input type="text" name="station_name" placeholder="Station Name" >
<input type="submit" value="Compute" >
</form>
</body>
</html>