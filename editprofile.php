<?php include 'inc/header.php'; ?>
<?php 
	$ctr = new Customer();
?>
<?php
	$cid = Session::get("customerId");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateCtr = $ctr->updateCustomerData($_POST, $cid);
    }
 ?>
<div class="main">
    <div class="content">
    	<div class="section group">
			<div class="col span_2_of_3">
			  	<div class="contact-form">
			  		<h2>Edit Profile</h2>
			  		<?php 
			  			if (isset($updateCtr)) {
			  				echo $updateCtr;
			  			}
			  		?>
				    <form action="" method="post">
				    	<?php 
				  			$id = Session::get("customerId");
				  			$cusdata = $ctr->getCustomerData($id);
				  			if ($cusdata) {
				  				$result = $cusdata->fetch_assoc();
				  		?>
				    	<div>
					    	<span><label>Name</label></span>
					    	<span><input type="text" name="name" value="<?php echo $result['name']; ?>"></span>
					    </div>
					    <div>
					    	<span><label>E-Mail</label></span>
					    	<span><?php echo $result['email']; ?> <br><a href="editemailpass.php">Change Email or Password</a></span>
					    </div>
					    <div>
					     	<span><label>Mobile No</label></span>
					    	<span><input type="text" name="phone" value="<?php echo $result['phone']; ?>"></span>
					    </div>
					    <div>
					    	<span><label>Address</label></span>
					    	<span><input type="text" name="address" value="<?php echo $result['address']; ?>"></span>
					    </div>
					    <div>
					    	<span><label>City</label></span>
					    	<span><input type="text" name="city" value="<?php echo $result['city']; ?>"></span>
					    </div>
					    <div>
					     	<span><label>Country</label></span>
					    	<span><input type="text" name="country" value="<?php echo $result['country']; ?>"></span>
					    </div>
					    <div>
					    	<span><label>Zip Code</label></span>
					    	<span><input type="text" name="zip" value="<?php echo $result['zip']; ?>"></span>
					    </div>
					    <div>
					   		<span><input type="submit" name="submit" value="Save"></span>
						</div>
						<?php } ?>
				    </form>
				</div>
			</div>
		</div>    	
    </div>
 </div>
<?php include 'inc/footer.php'; ?>