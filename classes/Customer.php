<?php 
	$fath = realpath(dirname(__FILE__));
	include_once $fath.'/../lib/Database.php';
	include_once $fath.'/../helpers/Format.php';
?>
<?php 
	class Customer
	{
		private $db;
		private $fm;
		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function customerRegister($data)
		{
			$name = $this->fm->validation($data['name']);
			$address = $this->fm->validation($data['address']);
			$city = $this->fm->validation($data['city']);
			$country = $this->fm->validation($data['country']);
			$zip = $this->fm->validation($data['zip']);
			$phone = $this->fm->validation($data['phone']);
			$email = $this->fm->validation($data['email']);
			$pass = $this->fm->validation($data['pass']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$address = mysqli_real_escape_string($this->db->link, $address);
			$city = mysqli_real_escape_string($this->db->link, $city);
			$country = mysqli_real_escape_string($this->db->link, $country);
			$zip = mysqli_real_escape_string($this->db->link, $zip);
			$phone = mysqli_real_escape_string($this->db->link, $phone);
			$email = mysqli_real_escape_string($this->db->link, $email);
			$pass = mysqli_real_escape_string($this->db->link, $pass);
			if (empty($name) || empty($city) || empty($country) || empty($phone) || empty($email) || empty($pass) || empty($zip)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}
			//Check Existing Email
			$emailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
			$checkemail = $this->db->select($emailquery);
			if ($checkemail != false) {
				$msg = "<span style='color:red; font-size:19px'>Email Already Exist.</span>";
				return $msg;
			}else{
				$pass = md5($pass);
				$query = "INSERT INTO tbl_customer(name, address, city, country, zip, phone, email, pass) VALUES ('$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$pass')";
				$row = $this->db->insert($query);
				if ($row) {
					$msg = "<span style='color:green; font-size:19px'>Customer Data Inserted Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Customer Data Not Inserted !</span>";
					return $msg;
				}
			}
		}
		public function customerLogin($data)
		{
			$email = $this->fm->validation($data['email']);
			$pass = $this->fm->validation($data['pass']);

			$email = mysqli_real_escape_string($this->db->link, $email);
			$pass = mysqli_real_escape_string($this->db->link, $pass);
			if (empty($email) || empty($pass)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}
			$pass = md5($pass);
			$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$pass'";
			$row = $this->db->select($query);
			if ($row) {
				$result = $row->fetch_assoc();
				Session::set("customerLogin", true);
				Session::set("customerId", $result['id']);
				Session::set("customerName", $result['name']);
				header("Location:index.php");
			}else{
				$msg = "<span style='color:red; font-size:17px'>Incorrect Email or password !</span>";
					return $msg;
			}
		}
		public function getCustomerData($id)
		{
			$query = "SELECT * FROM tbl_customer WHERE id = '$id'";
			$row = $this->db->select($query);
			return $row;
		}
		public function updateCustomerData($data, $cid)
		{
			$name = $this->fm->validation($data['name']);
			$address = $this->fm->validation($data['address']);
			$city = $this->fm->validation($data['city']);
			$country = $this->fm->validation($data['country']);
			$zip = $this->fm->validation($data['zip']);
			$phone = $this->fm->validation($data['phone']);
			//$email = $this->fm->validation($data['email']);

			$name = mysqli_real_escape_string($this->db->link, $name);
			$address = mysqli_real_escape_string($this->db->link, $address);
			$city = mysqli_real_escape_string($this->db->link, $city);
			$country = mysqli_real_escape_string($this->db->link, $country);
			$zip = mysqli_real_escape_string($this->db->link, $zip);
			$phone = mysqli_real_escape_string($this->db->link, $phone);
			//$email = mysqli_real_escape_string($this->db->link, $email);
			if (empty($name) || empty($city) || empty($country) || empty($phone) || /*empty($email) || */empty($zip)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}
			//Check Existing Email
			/*$emailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
			$checkemail = $this->db->select($emailquery);
			if ($checkemail != false) {
				$msg = "<span style='color:red; font-size:19px'>Email Already Exist.</span>";
				return $msg;
			}*/else{
				$query = "UPDATE tbl_customer
							SET
							name = '$name',
							address = '$address',
							city = '$city',
							country = '$country',
							zip = '$zip',
							phone = '$phone'
							WHERE id = '$cid'";
				$row = $this->db->insert($query);
				if ($row) {
					$msg = "<span style='color:green; font-size:19px'>Your Profile Updated Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Your Profile Not Updated !</span>";
					return $msg;
				}
			}
		}
		public function updateEmail($data, $cid)
		{
			$email = $this->fm->validation($data['email']);
			$email = mysqli_real_escape_string($this->db->link, $email);
			if (empty($email)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}
			//Check Existing Email
			$emailquery = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
			$checkemail = $this->db->select($emailquery);
			if ($checkemail != false) {
				$msg = "<span style='color:red; font-size:19px'>Email Already Exist.</span>";
				return $msg;
			}else{
				$query = "UPDATE tbl_customer
							SET
							email = '$email'
							WHERE id = '$cid'";
				$row = $this->db->insert($query);
				if ($row) {
					$msg = "<span style='color:green; font-size:19px'>Email Updated Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Email Not Updated !</span>";
					return $msg;
				}
			}
		}
		public function changePassword($data, $cid)
		{
			$oldpassword = $this->fm->validation($data['oldpassword']);
			$newpassword = $this->fm->validation($data['newpassword']);

			$oldpassword = mysqli_real_escape_string($this->db->link, $oldpassword);
			$newpassword = mysqli_real_escape_string($this->db->link, $newpassword);
			if (empty($oldpassword) ||  empty($newpassword)) {
				$msg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $msg;
			}
			$oldpassword = md5($oldpassword);
			$newpassword = md5($newpassword);
			//Check Old Password
			$passquery = "SELECT * FROM tbl_customer WHERE id = '$cid' AND pass = '$oldpassword' LIMIT 1";
			$checkpass = $this->db->select($passquery);
			if ($checkpass == false) {
				$msg = "<span style='color:red; font-size:19px'>Old Password Not Match.</span>";
				return $msg;
			}else{
				$query = "UPDATE tbl_customer
							SET
							pass = '$newpassword'
							WHERE id = '$cid'";
				$row = $this->db->insert($query);
				if ($row) {
					$msg = "<span style='color:green; font-size:19px'>Password Change Successfully.</span>";
					return $msg;
				}else{
					$msg = "<span style='color:red; font-size:19px'>Password Not Change !</span>";
					return $msg;
				}
			}
		}
		public function loginAtOrder($data)
		{
			$email = $data['email'];
			$pass = md5($data['pass']);
			$query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$pass'";
			$row = $this->db->select($query);
			if ($row) {
				$result = $row->fetch_assoc();
				Session::set("customerLogin", true);
				Session::set("customerId", $result['id']);
				Session::set("customerName", $result['name']);
			}
		}
	}
?>