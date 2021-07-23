<?php 
	$fath = realpath(dirname(__FILE__));
	include $fath.'/../lib/Session.php';
	Session::checkLogin();
	include_once $fath.'/../lib/Database.php';
	include_once $fath.'/../helpers/Format.php';
 ?>
<?php 
	/**
	 * Admin Login
	 */
	class Adminlogin
	{
		private $db;
		private $fm;
		function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function adminLogin($adminUser, $adminPass)
		{
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);
			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

			if (empty($adminUser) || empty($adminPass)) {
				$loginmsg = "<span style='color:red; font-size:19px'>Filled must not be empty.</span>";
				return $loginmsg;
			}else{
				$query = "SELECT * FROM tbl_admin WHERE adminUser = '$adminUser' and adminPass = '$adminPass'";
				$result = $this->db->select($query);
				if ($result != false) {
					$value = $result->fetch_assoc();
					Session::set("login", true);
					Session::set("adminId", $value['adminId']);
					Session::set("adminUser", $value['adminUser']);
					Session::set("adminName", $value['adminName']);
					header("Location: dashboard.php");
				}else{
					$loginmsg = "<span style='color:red; font-size:19px'>Username or Password not match !</span>";
				return $loginmsg;
				}
			}
		}
	}
 ?>