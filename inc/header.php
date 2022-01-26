<?php
	$fath = realpath(dirname(__FILE__));
	include_once $fath.'/../lib/Session.php';
	Session::init();
	spl_autoload_register(function($class){
		include_once 'classes/'.$class.'.php';
	});
?>
<?php 
	$ct = new Cart();
?>
<?php 
	if (isset($_GET['cid'])) {
		$delCartLogout = $ct->deleteCartbyLogout();
		Session::destroy();
	}
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<!-- <script type="text/javascript" src="js/jquerymain.js"></script> -->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 

<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo2.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product">
								<?php 
									$viewCart = $ct->selectCart();
									if ($viewCart) {
										//echo "($".Session::get('gtotal').")";
										$sum = 0;
										while ($result = $viewCart->fetch_assoc()) {
											$total = $result['price']*$result['quantity'];
											$sum = $sum + $total;
											$vat = $sum*0.15;
											$gtotal = $sum+$vat;
										}
										echo "($".$gtotal.")";
									}else{
										echo "($0)";
									}
								 ?>
							</span>
						</a>
					</div>
			    </div>
		   <div class="login">
		   	<?php 
				$login = Session::get("customerLogin");
				if ($login == false) {
			?>
		   	<a href="login.php">Login</a>
		   	<?php }else{ ?>
		   	<a href="?cid=<?php echo Session::get('customerId'); ?>">Logout</a>
		   	<?php } ?>
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
		<li><a href="index.php">Home</a></li>
		<li><a href="products.php">Products</a> </li>
		<li><a href="topbrands.php">Top Brands</a></li>
		<?php 
	  	$checkCart = $ct->selectCart();
	  	if ($checkCart){
		?>
		<li><a href="cart.php">Cart</a></li>
		<?php } ?>

		<?php 
		$cid = Session::get("customerId");
	  	$checkOrder = $ct->selectOrder($cid);
	  	if ($checkOrder){
		?>
		<li><a href="orderdetails.php">Order</a></li>
		<?php } ?>

		<?php
		if ($login == true) {
		?>
		<li><a href="profile.php">Profile</a> </li>
		<li><a href="wishlist.php">Wishlist</a> </li>
		<?php } ?>
		<li><a href="contact.php">Contact</a> </li>
		<div class="clear"></div>
	</ul>
</div>