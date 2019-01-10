<?php
	session_start();
	echo "Logging Out...";
	unset($_SESSION['user_id']);
	header("refresh: 3; url=index.php");
?>