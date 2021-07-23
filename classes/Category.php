<?php 
	$fath = realpath(dirname(__FILE__));
	include_once $fath.'/../lib/Database.php';
	include_once $fath.'/../helpers/Format.php';
 ?>
<?php 
	class Category
	{
		private $db;
		private $fm;
		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insertCat($catName)
		{
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			if (empty($catName)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_category (catName) VALUES ('$catName')";
				$result = $this->db->insert($query);
				if ($result) {
					$msg = "<span style='color:green; font-size:19px'>Data Inserted Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Data Not Inserted !</span>";
					return $msg;
				}
			}
		}
		public function getCatlist()
		{
			$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getValue($id)
		{
			$query = "SELECT * FROM tbl_category WHERE catId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function updateCat($catName, $id)
		{
			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if (empty($catName)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}else{
				$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
				$result = $this->db->update($query);
				if ($result) {
					$msg = "<span style='color:green; font-size:19px'>Data Updated Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Data Not Updated !</span>";
					return $msg;
				}
			}
		}
		public function deleteCat($id)
		{
			$query = "DELETE FROM tbl_category WHERE catId = '$id'";
			$result = $this->db->delete($query);
			if ($result) {
					$msg = "<span style='color:green; font-size:19px'>Data Deleted Successfully.</span>";
					return $msg;
			}else{
				$msg = "<span style='color:red; font-size:19px'>Data Not Deleted !</span>";
				return $msg;
			}
		}
	}
 ?>