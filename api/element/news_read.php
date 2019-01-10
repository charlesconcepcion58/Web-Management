<?php 
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	include_once '../config/database.php';
	include_once '../objects/news_info.php';

	$database = new Database();
	$db = $database->getConnection();

	$news = new News($db);

	$stmt = $news->read();
	$num = $stmt->rowcount();

	if($num>0) {
		$news_arr = array();
		$news_arr = array();

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

			extract($row);

			$news_item = array(
				"id" => $id,
				"art_title" => $art_title,
				"author_fname" => $author_fname,
				"author_lname" => $author_lname,
				"art_content" => $art_content,
				"pub_date" => $pub_date,
				"art_img_path" => $art_img_path
			);

			array_push($news_arr, $news_item);
		}

		http_response_code(200);

		echo json_encode($news_arr);
	}

	else {
		http_response_code(404);

		echo json_encode(array("message" => "No news found."));
	}
?>