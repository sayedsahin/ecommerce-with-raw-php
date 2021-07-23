<?php include 'inc/header.php'; ?>
<?php 
	$login = Session::get("customerLogin");
	if ($login == false) {
		header("Location:login.php");
	}
?>
<?php 
	$ctr = new Customer();
?>
<style>
.font{font-weight: bold;}
button a{color: #757575;}
.company_address a{color: #757575;}
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
			<div class="col span_2_of_3">
				<div class="contact-form">
			  		<h2>Your Profile</h2>
			  		<?php 
			  			$id = Session::get("customerId");
			  			$cusdata = $ctr->getCustomerData($id);
			  			if ($cusdata) {
			  				$result = $cusdata->fetch_assoc();
			  		?>
			    	<div>
				    	<span class="font"><label>Name</label></span>
				    	<span><?php echo $result['name']; ?></span>
				    </div>
				    <div>
				    	<span class="font"><label>E-Mail</label></span>
				    	<span><?php echo $result['email']; ?></span>
				    </div>
				    <div>
				     	<span class="font"><label>Mobile No</label></span>
				    	<span><?php echo $result['phone']; ?></span>
				    </div>
				    <div>
				    	<span class="font"><label>Address</label></span>
				    	<span><?php echo $result['address']; ?></span>
				    </div>
				    <div>
				    	<span class="font"><label>City</label></span>
				    	<span><?php echo $result['city']; ?></span>
				    </div>
				    <div>
				    	<span class="font"><label>Country</label></span>
				    	<span><?php echo $result['country']; ?></span>
				    </div>
				    <div>
				    	<span class="font"><label>Zip</label></span>
				    	<span><?php echo $result['zip']; ?></span>
				    </div>
				    <button><a href="editprofile.php">Edit</a></button>
					<?php } ?>
				</div>
			</div>
			<div class="col span_1_of_3">
  			<div class="company_address">
			     	<h2>Contuct and Follow</h2>
			   		<p>Website: <span><a href="#">Website</a></span></p>
			   		<p>Facebook: <span><a href="#">Facebook</a></span></p>
			   		<p>Twitter: <span><a href="#">Twitter</a></span></p>
			   		<p>LinkedIn: <span><a href="#">LinkedIn</a></span></p>
			    </div>
			</div>
		</div>    	
    </div>
 </div>
<?php include 'inc/footer.php'; ?>