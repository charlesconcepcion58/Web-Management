<?php 
	class News {
		private $conn;
		private $table_name = "tb_newsinfo";

		public $id;
		public $art_title;
		public $author_fname;
		public $author_lname;
		public $art_content;
		public $pub_date;
		public $art_img_path;

		public function __construct($db) {
			$this->conn = $db;
		}
		function read() {
			$query = "SELECT n.art_title as art_title, n.id, n.author_fname, n.author_lname, n.art_content, n.pub_date, n.art_img_path
			FROM 
				  ". $this->table_name ." n
				  ORDER BY 
				  	n.pub_date DESC";

			$stmt = $this->conn->prepare($query);

			$stmt->execute();

			return $stmt;
		}
	}

	class Announcement {
		private $conn;
		private $table_name = "tb_anninfo";

		public $ann_id;
		public $art_title;
		public $author_fname;
		public $author_lname;
		public $art_content;
		public $pub_date;
		public $art_img_path;

		public function __construct($db) {
			$this->conn = $db;
		}
		function read() {
			$query = "SELECT n.art_title as art_title, n.news_id, n.author_fname, n.author_lname, n.art_content, n.pub_date, n.art_img_path
			FROM 
				  ". $this->table_name ." n
				  ORDER BY 
				  	n.pub_date DESC";

			$stmt = $this->conn->prepare($query);

			$stmt->execute();

			return $stmt;
		}
	}	
?>