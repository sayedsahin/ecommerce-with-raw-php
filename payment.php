<?php include 'inc/header.php'; ?>
<?php 
	/*$login = Session::get("customerLogin");
	if ($login == false) {
		header("Location:login.php");
	}*/
?>
<?php 
	$ctr = new Customer();
?>
<style>
button{background-color: #e03e3d;margin: 3px 5px;padding: 5px 18px;border: 1px solid #ccc;border-radius: 5px;}
button a{color: #fff; font-size: 22px; font-weight: bold;}
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
			<div class="col span_2_of_3">
				<div class="contact-form">
			  		<h2>Payment Option</h2>
				    <button><a href="paymentoffline.php">Offline Payment</a></button>
				    <button><a href="paymentonline.php">Online Payment</a></button>
				    <button><a href="paymentonline.php">Bkash Payment</a></button>
				</div>
			</div>
		</div>    	
    </div>
 </div>
<?php include 'inc/footer.php'; ?>