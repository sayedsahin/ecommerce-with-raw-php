<?php 
	$fath = realpath(dirname(__FILE__));
	include_once $fath.'/../lib/Database.php';
	include_once $fath.'/../helpers/Format.php';
?>
<?php 
	class Cart
	{
		private $db;
		private $fm;
		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insertCart($quantity, $id)
		{
			$quantity = $this->fm->validation($quantity);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$productId = mysqli_real_escape_string($this->db->link, $id);
			$sesId = session_id();

			//This query for productName, price and image.
			$squery = "SELECT * FROM tbl_product WHERE productId = '$id'";
			$srow = $this->db->select($squery)->fetch_assoc();
			$productName = $srow['productName'];
			$price = $srow['price'];
			$image = $srow['image'];

			//Check Duplicate Product
			$check_query = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sesId = '$sesId'";
			$check_row = $this->db->select($check_query);
			if ($check_row) {
				$msg = "Product Already Added !";
				return $msg;
			}else{
				//This insert query
				$query = "INSERT INTO tbl_cart (sesId, productId, productName, price, quantity, image) VALUES ('$sesId', '$productId', '$productName', '$price', '$quantity', '$image')";
				$row = $this->db->insert($query);
				if ($row) {
					header('Location: cart.php');
				}else{
					header('Location: 404.php');
				}
			}
		}
		public function selectCart()
		{
			$sesId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sesId = '$sesId'";
			$row = $this->db->select($query);
			return $row;
		}
		public function updateQuantity($cartId, $quantity)
		{
			$cartId = mysqli_real_escape_string($this->db->link, $cartId);
			$quantity = mysqli_real_escape_string($this->db->link, $quantity);
			$query = "UPDATE tbl_cart 
						SET
						quantity = '$quantity'
						WHERE cartId = '$cartId'";
			$row = $this->db->update($query);
			if ($row) {
				echo "";
			}else{
				$msg = "<span style='color:red; font-size:19px'>Quantity Not Updated !</span>";
				return $msg;
			}
		}
		public function deleteCart($id)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$query = "DELETE FROM tbl_cart WHERE cartId = '$id'";
			$row = $this->db->delete($query);
			if ($row) {
				header('Location: cart.php');
			}else{
				$msg = "<span style='color:red; font-size:19px'>Cart Not Remove !</span>";
				return $msg;
			}
		}
		public function deleteCartbyLogout()
		{
			$sid = session_id();
			$query = "DELETE FROM tbl_cart WHERE sesId = '$sid'";
			$this->db->delete($query);
		}
		public function insertOrder($cid)
		{
			$cid = mysqli_real_escape_string($this->db->link, $cid);
			$sesId = session_id();
			$query = "SELECT * FROM tbl_cart WHERE sesId = '$sesId'";
			$row = $this->db->select($query);
			if ($row) {
				while ($result = $row->fetch_assoc()) {
					$productId = $result['productId'];
					$productName = $result['productName'];
					$quantity = $result['quantity'];
					$price = $result['price'];
					$image = $result['image'];
					$insert_query = "INSERT INTO tbl_order (cId, productId, productName, price, quantity, image) VALUES ('$cid', '$productId', '$productName', '$price', '$quantity', '$image')";
					$insert_row = $this->db->insert($insert_query);
				}
			}
		}
		public function totalOrderAmount($cid)
		{
			$query = "SELECT * FROM tbl_order WHERE cId = '$cid' AND time = now()";
			$row = $this->db->select($query);
			return $row;
		}
		public function selectOrder($cid)
		{
			$query = "SELECT * FROM tbl_order WHERE cId = '$cid'";
			$row = $this->db->select($query);
			return $row;
		}
		public function getOrderbyAdmin()
		{
			$query = "SELECT * FROM tbl_order ORDER BY time";
			$row = $this->db->select($query);
			return $row;
		}
		public function productShift($id, $cid, $time)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$cid = mysqli_real_escape_string($this->db->link, $cid);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$query = "UPDATE tbl_order
						SET
						status = '1'
						WHERE orderId = '$id' AND cId = '$cid' AND time = '$time'";
			$row = $this->db->update($query);
			if ($row) {
				$msg = "<span style='color:green; font-size:19px'>Product Shifted Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red; font-size:19px'>Product Not Shifted !</span>";
				return $msg;
			}
		}
		public function productConfirm($id, $cid, $time)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$cid = mysqli_real_escape_string($this->db->link, $cid);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$query = "UPDATE tbl_order
						SET
						status = '2'
						WHERE orderId = '$id' AND cId = '$cid' AND time = '$time'";
			$row = $this->db->update($query);
			if ($row) {
				$msg = "<span style='color:green; font-size:19px'>Product Confirm Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red; font-size:19px'>Product Not Confirm !</span>";
				return $msg;
			}
		}
		public function orderDelete($id, $cid, $time)
		{
			$id = mysqli_real_escape_string($this->db->link, $id);
			$cid = mysqli_real_escape_string($this->db->link, $cid);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$query = "DELETE FROM tbl_order WHERE orderId = '$id' AND cId = '$cid' AND time = '$time'";
			$row = $this->db->update($query);
			if ($row) {
				$msg = "<span style='color:green; font-size:19px'>Product Remove Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span style='color:red; font-size:19px'>Product Not Remove !</span>";
				return $msg;
			}
		}
	}
?>