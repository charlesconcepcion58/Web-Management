<?php

require '../vendor/autoload.php';


$db_hostname="localhost";
$db_username="root";
$db_password="";
$db_database="db_webms";


$mysqli = mysqli_init();
$mysqli->real_connect($db_hostname, $db_username, $db_password, $db_database);

$app = new Slim\App();

$app->get('/arrival', function($request, $response, $args) {
	$query = <<<QUERY
SELECT
	arrival_id AS id,
	station_name AS station,
	train_number As train,
	time_in,
	time_out,
	date_departed AS date
FROM tb_tarrival;
QUERY;

	global $mysqli;
	$result = $mysqli->query($query);

	return $response->withJson($result->fetch_all(MYSQLI_ASSOC));
});

$app->get('/announcement-items', function($request, $response, $args) {
	$query = <<<QUERY
SELECT
	ann_id AS id,
	CONCAT(creator_fname, ' ', creator_lname) AS creator,
	pub_date AS date,
	ann_img_path AS image
FROM tb_anninfo;
QUERY;

	global $mysqli;
	$result = $mysqli->query($query);

	return $response->withJson($result->fetch_all(MYSQLI_ASSOC));
});

$app->post('/tickets', function($request, $response, $args) {

	$username = $request->getParam('tickets');

	$query = <<<QUERY
SELECT
	ticket_id AS id,
	ticket_start AS start,
	ticket_end AS end,
	ticket_price AS price,
FROM tb_tickets;
QUERY;

	global $mysqli;
	$result = $mysqli->query($query);

	return $response->withJson($result->fetch_all(MYSQLI_ASSOC));
});

$app->post('/login', function($request, $response, $args) {

	$username = $request->getParam('username');

	$query = <<<QUERY
SELECT
	user_id AS id,
	username, 
	fname AS first_name,
	lname AS last_name,
	email,
	pwd AS password
FROM tb_maccounts;
QUERY;

	global $mysqli;
	$result = $mysqli->query($query);

	return $response->withJson($result->fetch_all(MYSQLI_ASSOC));
});


$app->get('/news-items', function($request, $response, $args) {
	$query = <<<QUERY
SELECT
	news_id AS id,
	art_title AS title,
	CONCAT(author_fname, ' ', author_lname) AS author,
	pub_date AS date
FROM tb_newsinfo;
QUERY;
	global $mysqli;
	$result = $mysqli->query($query);
	$news_items = $result->fetch_all(MYSQLI_ASSOC);
	$result->free();
	return $response->withJson(array_map(function ($item) {
		return new class($item) {
			public function __construct($item) {
				$this->id = (int) $item['id'];
				$this->title = $item['title'];
				$this->author = $item['author'];
				$this->date = (new DateTime($item['date']))->format(DateTime::ATOM);
			}
		};
	}, $news_items));
});
$app->get('/news-items/{id}', function($request, $response, $args) {
	$query = <<<QUERY
SELECT
	news_id AS id,
	art_title AS title,
	CONCAT(author_fname, ' ', author_lname) AS author,
	pub_date AS date,
	art_content AS content
FROM tb_newsinfo
WHERE news_id = {$args['id']};
QUERY;
	global $mysqli;
	$result = $mysqli->query($query);
	if ($result->num_rows != 1) {
		return $response->withStatus(404);
	}
	$news_item = $result->fetch_assoc();
	$result->free();
	return $response->withJson(new class($news_item) {
		public function __construct($item) {
			$this->id = (int) $item['id'];
			$this->title = $item['title'];
			$this->author = $item['author'];
			$this->date = (new DateTime($item['date']))->format(DateTime::ATOM);
			$this->content = $item['content'];
		}
	});
});


$app->run();


$mysqli->close();
