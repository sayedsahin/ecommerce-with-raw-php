<?php include 'inc/header.php'; ?>
<?php 
	$ctr = new Customer();
?>
<?php
	$cid = Session::get("customerId");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit1'])) {
        $updateEmail = $ctr->updateEmail($_POST, $cid);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit2'])) {
        $changepass = $ctr->changePassword($_POST, $cid);
    }
 ?>
<div class="main">
    <div class="content">
    	<div class="section group">
			<div class="col span_2_of_3">
			  	<div class="contact-form">
			  		<h2>Update Email</h2>
			  		<?php 
			  			if (isset($updateEmail)) {
			  				echo $updateEmail;
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
					    	<span><label>E-Mail</label></span>
					    	<span><input type="text" name="email" value="<?php echo $result['email']; ?>"></span>
					    </div>
					    <div>
					   		<span><input type="submit" name="submit1" value="Update"></span>
						</div>
						<?php } ?>
				    </form>
				</div>
				<div class="contact-form">
			  		<h2>Change Password</h2>
			  		<?php 
			  			if (isset($changepass)) {
			  				echo $changepass;
			  			}
			  		?>
				    <form action="" method="post">
					    <div>
					     	<span><label>Old Password</label></span>
					    	<span><input type="text" name="oldpassword" placeholder="Enter Old Password..."></span>
					    </div>
					    <div>
					    	<span><label>New Password</label></span>
					    	<span><input type="text" name="newpassword" placeholder="Enter New Password..."></span>
					    </div>
					    <div>
					   		<span><input type="submit" name="submit2" value="Change"></span>
						</div>
				    </form>
				</div>
			</div>
		</div>    	
    </div>
 </div>
<?php include 'inc/footer.php'; ?>