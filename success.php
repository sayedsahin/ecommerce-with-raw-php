<?php include 'inc/header.php'; ?>
<?php 
	/*$login = Session::get("customerLogin");
	if ($login == false) {
		header("Location:login.php");
	}*/
?>
<style>
.succsesspage{font-family: monospace;}
button{background-color: green;margin: 3px 5px;padding: 5px 18px;border: 1px solid #ccc;border-radius: 5px;}
.succsesspage p{color: #6C6C6C; font-size: 18px; margin: 7px 0px;}
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
			<div class="col span_2_of_3">
				<div class="succsesspage contact-form">
			  		<h2>Payment Option</h2>
			  		<?php 
			  			$cid = Session::get("customerId");
			  			$totalamount = $ct->totalOrderAmount($cid);
			  			if ($totalamount) {
			  				$sum = 0;
							while ($result = $totalamount->fetch_assoc()) {
								$total = $result['price']*$result['quantity'];
								$sum = $sum + $total;
								$vat = $sum*0.15;
								$gtotal = $sum+$vat;
							}
			  		?>
				    <p>Total payable amount (Including Vat): $<?php echo $gtotal; ?></p>
					<?php } ?>
				    <p>Thanks for purchase. Receive your order successfully. we will contact you ASAP with delivery details. Here is your order details. <a href="orderdetails.php">Visit Here..</a></p>
				</div>
			</div>
		</div>    	
    </div>
 </div>
<?php include 'inc/footer.php'; ?>