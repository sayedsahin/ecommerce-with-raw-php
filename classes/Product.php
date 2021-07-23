<?php 
	$fath = realpath(dirname(__FILE__));
	include_once $fath.'/../lib/Database.php';
	include_once $fath.'/../helpers/Format.php';
?>
<?php 
	class Product
	{
		private $db;
		private $fm;
		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insertProduct($data, $file)
		{
			$productName = $this->fm->validation($data['productName']);
			$catId = $this->fm->validation($data['catId']);
			$brandId = $this->fm->validation($data['brandId']);
			$body = $data['body']; //eti validation korle <p> entity hoye jay
			$price = $this->fm->validation($data['price']);
			$type = $this->fm->validation($data['type']);

			$productName = mysqli_real_escape_string($this->db->link, $productName);
			$catId = mysqli_real_escape_string($this->db->link, $catId);
			$brandId = mysqli_real_escape_string($this->db->link, $brandId);
			$body = mysqli_real_escape_string($this->db->link, $body);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$type = mysqli_real_escape_string($this->db->link, $type);

			$permited = array('jpg', 'jpeg', 'png', 'gif' );
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_temp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if (empty($productName) || empty($catId) || empty($brandId) || empty($body) || empty($price) || empty($file_name) || empty($type)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}elseif ($file_size > 1048576) {
				$msg = "<div style='color:red; font-size:19px'>Image size should be less then 1MB.</div>";
				return $msg;
			}elseif (in_array($file_ext, $permited) === false) {
				$msg = "<div style='color:red; font-size:19px'>You can upload only: ".implode(', ', $permited)."</div>";
				return $msg;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_product(productName, catId, brandId, body, price, image, type) VALUES ('$productName', '$catId', '$brandId', '$body', '$price', '$uploaded_image', '$type')";
				$row = $this->db->insert($query);
				if ($row) {
					$msg = "<span style='color:green; font-size:19px'>Product Inserted Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Product Not Inserted !</span>";
					return $msg;
				}
			}
		}
		public function getAllProduct()
		{
			//Inner Join Query
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
						FROM tbl_product
						INNER JOIN tbl_category
						ON tbl_product.catId = tbl_category.catId
						INNER JOIN tbl_brand
						ON tbl_product.brandId = tbl_brand.brandId
						ORDER BY tbl_product.productId DESC";
			
			//Alias Query
			/*$query = "SELECT p.*, c.catName, b.brandName
						FROM tbl_product as p, tbl_category as c, tbl_brand as b
						WHERE p.catId = c.catId AND p.brandId = b.brandId
						ORDER BY p.productId DESC";*/
			$row = $this->db->select($query);
			return $row;
		}
		public function slelectProById($id)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
			$row = $this->db->select($query);
			return $row;
		}
		public function updateProduct($data, $file, $id)
		{
			$productName = $this->fm->validation($data['productName']);
			$catId = $this->fm->validation($data['catId']);
			$brandId = $this->fm->validation($data['brandId']);
			$body = $data['body']; //eti validation korle <p> entity hoye jay
			$price = $this->fm->validation($data['price']);
			$type = $this->fm->validation($data['type']);

			$productName = mysqli_real_escape_string($this->db->link, $productName);
			$catId = mysqli_real_escape_string($this->db->link, $catId);
			$brandId = mysqli_real_escape_string($this->db->link, $brandId);
			$body = mysqli_real_escape_string($this->db->link, $body);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$type = mysqli_real_escape_string($this->db->link, $type);

			$permited = array('jpg', 'jpeg', 'png', 'gif' );
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_temp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if (empty($productName) || empty($catId) || empty($brandId) || empty($body) || empty($price) || empty($type)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}elseif (!empty($file_name)) {
				if ($file_size > 1048576) {
					$msg = "<div style='color:red; font-size:19px'>Image size should be less then 1MB.</div>";
					return $msg;
				}elseif (in_array($file_ext, $permited) === false) {
					$msg = "<div style='color:red; font-size:19px'>You can upload only: ".implode(', ', $permited)."</div>";
					return $msg;
				}else{
					//Delete Image From Directory
					$imgquery = "SELECT * FROM tbl_product WHERE productId = '$id'";
					$delimg = $this->db->select($imgquery);
					if ($delimg) {
						while ($delresult = $delimg->fetch_assoc()) {
							$dellink = $delresult['image'];
							unlink($dellink);
						}
					}
					//Edit Query When With Image
					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE tbl_product
								SET
								productName = '$productName',
								catId = '$catId',
								brandId = '$brandId',
								body = '$body',
								price = '$price',
								image = '$uploaded_image',
								type = '$type'
								WHERE productId = '$id'";
					$row = $this->db->update($query);
					if ($row) {
						$msg = "<span style='color:green; font-size:19px'>Product Updated Successfully.</span>";
						return $msg;
					}else{
						$msg = "<span style='color:red; font-size:19px'>Product Not Updated !</span>";
						return $msg;
					}
				}
			}else{
				//Edit Query When Without Image
				$query = "UPDATE tbl_product
							SET
							productName = '$productName',
							catId = '$catId',
							brandId = '$brandId',
							body = '$body',
							price = '$price',
							type = '$type'
							WHERE productId = '$id'";
				$row = $this->db->update($query);
				if ($row) {
					$msg = "<span style='color:green; font-size:19px'>Product Updated Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Product Not Updated !</span>";
					return $msg;
				}
			}
		}
		public function deleteProduct($id)
		{
			$query = "SELECT * FROM tbl_product WHERE productId = '$id'";
			$row = $this->db->select($query);
			if ($row) {
				while ($result = $row->fetch_assoc()) {
					$dellink = $result['image'];
					unlink($dellink);
				}
			}
			$delquery = "DELETE FROM tbl_product WHERE productId = '$id'";
			$delrow = $this->db->delete($delquery);
			if ($delrow) {
				$msg = "<span style='color:green; font-size:19px'>Product Deleted Successfully.</span>";
					return $msg;
			}else{
				$msg = "<span style='color:red; font-size:19px'>Product Not Deleted !</span>";
				return $msg;
			}
		}
		//End Admin Panel

		//Start Front View
		public function selectFetureProduct()
		{
			$query = "SELECT * FROM tbl_product WHERE type = '1' ORDER BY productId DESC LIMIT 4";
			$row = $this->db->select($query);
			return $row;
		}
		public function selectNewProduct()
		{
			$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
			$row = $this->db->select($query);
			return $row;
		}
		public function selectProduct($id)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
			FROM tbl_product
			INNER JOIN tbl_category
			ON tbl_product.catId = tbl_category.catId
			INNER JOIN tbl_brand
			ON tbl_product.brandId = tbl_brand.brandId
			WHERE tbl_product.productId = '$id'
			ORDER BY tbl_product.productId DESC";
			$row = $this->db->select($query);
			return $row;
		}
		public function selectLetestPro($id)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT * FROM tbl_product WHERE brandId = '$id' ORDER BY productId DESC LIMIT 1";
			$row = $this->db->select($query);
			return $row;
		}
		public function selectProByCat($id)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY productId DESC";
			$row = $this->db->select($query);
			return $row;
		}
		//Compare Page
		public function selectCompare($id)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT * FROM tbl_product WHERE productId = '$id' LIMIT 1";
			$row = $this->db->select($query);
			return $row;
		}
		public function SelectCompareTow()
		{
			$query = "SELECT * FROM tbl_product ORDER BY productId DESC";
			$row = $this->db->select($query);
			return $row;
		}
		//Wish List Page
		public function insertWishlist($customerId, $id)
		{
			$check_query = "SELECT * FROM tbl_wlist WHERE productId = '$id' AND customerId = '$customerId'";
			$check_row = $this->db->select($check_query);
			if ($check_row) {
				$msg = "Product Already Wish Listed !";
				return $msg;
			}else{
				$query = "INSERT INTO tbl_wlist(customerId, productId) VALUES ('$customerId', '$id')";
				$row = $this->db->insert($query);
				if ($row) {
					$msg = "<span style='color:green; font-size:19px'>Wish list Added Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Wish list Not Added !</span>";
					return $msg;
				}
			}
		}
		public function selectWishlist($id)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "SELECT tbl_wlist.*, tbl_product.*, tbl_customer.id
			FROM tbl_wlist
			INNER JOIN tbl_product
			ON tbl_wlist.productId = tbl_product.productId
			INNER JOIN tbl_customer
			ON tbl_wlist.customerId = tbl_customer.id
			WHERE tbl_wlist.customerId = '$id'
			ORDER BY tbl_wlist.wId DESC";
			$row = $this->db->select($query);
			return $row;
		}
		public function deleteWishlist($wid)
		{
			$query = "DELETE FROM tbl_wlist WHERE wId = '$wid'";
			$row = $this->db->delete($query);
			if ($row) {
				$msg = "<span style='color:green; font-size:19px'>Wishlist Deleted Successfully.</span>";
					return $msg;
			}else{
				$msg = "<span style='color:red; font-size:19px'>Wishlist Not Deleted !</span>";
				return $msg;
			}
		}
	}
?>