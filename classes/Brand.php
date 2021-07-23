<?php 
	$fath = realpath(dirname(__FILE__));
	include_once $fath.'/../lib/Database.php';
	include_once $fath.'/../helpers/Format.php';
 ?>
<?php 
	class Brand
	{
		private $db;
		private $fm;
		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insertBrand($brandName)
		{
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			if (empty($brandName)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_brand (brandName) VALUES ('$brandName')";
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
		public function getBrandlist()
		{
			$query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
			$result = $this->db->select($query);
			return $result;
		}
		public function getValue($id)
		{
			$query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function updateBrand($brandName, $id)
		{
			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);
			$id = mysqli_real_escape_string($this->db->link, $id);
			if (empty($brandName)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}else{
				$query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
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
		public function deleteBrand($id)
		{
			$query = "DELETE FROM tbl_brand WHERE brandId = '$id'";
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