<?php 
	class Format
	{
		
		public function formatDate($date)
		{
			return date('j F Y, g:i a', strtotime($date));
		}
		public function textShorten($text, $limit = 400)
		{
			$text = $text. " ";
			$text = substr($text, 0, $limit);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text."...";
			return $text;
		}
		public function validation($data)
		{
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		//<title></title>
		public function title()
		{
			$db = new Database();
			if (isset($_GET['id'])) {
				$posttitleid = $_GET['id'];
				$query = "SELECT * FROM tbl_post WHERE id = '$posttitleid'";
				$postitle = $db->select($query);
				if ($postitle) {
					while ($result = $postitle->fetch_assoc()) {
						return $result['title'];
					}
				}
			}elseif (isset($_GET['pageid'])) {
				$pagetitleid = $_GET['pageid'];
				$query = "SELECT * FROM tbl_page WHERE id = '$pagetitleid'";
				$pagetitle = $db->select($query);
				if ($pagetitle) {
					while ($result = $pagetitle->fetch_assoc()) {
						return $result['name'];
					}
				}
			}elseif (isset($_GET['category'])) {
				$cattitleid = $_GET['category'];
				$query = "SELECT * FROM tbl_category WHERE id = '$cattitleid'";
				$cattitle = $db->select($query);
				if ($cattitle) {
					while ($result = $cattitle->fetch_assoc()) {
						return $result['name'];
					}
				}
			} elseif(!isset($_GET[''])) {
				$path = $_SERVER['SCRIPT_FILENAME'];
				$title = basename($path, '.php');
				$title = str_replace("-"," ", $title);
				$title = str_replace("_"," ", $title);
				$title = ucwords($title);
				return $title;
			}
		}
	}
 ?>