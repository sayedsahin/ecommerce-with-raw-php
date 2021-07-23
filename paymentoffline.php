<?php include 'inc/header.php'; ?>
<?php 
	$fm = new Format();
	$ctr = new Customer();
 ?>
<?php
	$cid = Session::get("customerId");
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $updateCtr = $ctr->updateCustomerData($_POST, $cid);

        $insertOrder = $ct->insertOrder($cid);
        $delCartLogout = $ct->deleteCartbyLogout();
        header("Location:success.php");
    }elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        $customerReg = $ctr->customerRegister($_POST);//User Registration
        $customerLog = $ctr->loginAtOrder($_POST);//User Login

    	$cuid = Session::get("customerId");//User Customer Id
        $insertOrder = $ct->insertOrder($cuid);//Cart to Order Table Data Insert
    	if ($insertOrder) {
    		$delCartLogout = $ct->deleteCartbyLogout();//Delete Cart Table Data
	    	if ($delCartLogout) {
				header("Location:success.php");
			}
    	}
		
    }
 ?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
		    	<h2 style="width: auto;">Order Products</h2>
				<table class="tblone" style="float: left;">
					<tr>
						<th>No</th>
						<th>Product Name</th>
						<th>Image</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total Price</th>
					</tr>
					<?php 
						$selectCart = $ct->selectCart();
						if ($selectCart) {
							$i=0;
							$sum=0;
							while ($result = $selectCart->fetch_assoc()) {
								$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $fm->textshorten($result['productName'], 20); ?></td>
						<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
						<td>$<?php echo $result['price']; ?></td>
						<td><?php echo $result['quantity']; ?></td>
						<td>
						<?php
							$total = $result['price']*$result['quantity'];
							echo "$".$total;
						?>
						</td>
					</tr>
					<?php $sum = $sum + $total; ?>
					<?php } }else{
						//Evabe Na likhle order e click korle success.php te na giye index.php te chole jay
						if ($_SERVER['REQUEST_METHOD'] != 'POST') {
							header("Location:index.php");
						}
					} ?>					
				</table>
				<table style="float:right;text-align:left;" width="40%">
					<?php if ($selectCart) { ?>
					<tr>
						<th>Sub Total : </th>
						<td>$<?php echo $sum; ?></td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td>
							<?php 
								$vat = $sum*0.15;
								echo '$'.$vat.'(15%)';
							?>
						</td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<?php $gtotal = $sum+$vat; ?>
						<td>$<?php echo $gtotal; ?></td>
					</tr>
					<?php //Session::set("gtotal", "$gtotal"); ?>
					<?php } ?>
			   </table>
			</div>
    	</div>  	
       <div class="clear"></div>
           	<div class="section group">
			<div class="col span_2_of_3">
			  	<div class="contact-form">
			  		<h2>Your Address</h2>
			  		<?php 
		    		if (isset($customerReg)) {
		    			echo $customerReg;
		    		}
		    		?>
				    <form action="" method="post">
				    	<?php 
				  			$id = Session::get("customerId");
				  			$cusdata = $ctr->getCustomerData($id);
				  			if ($cusdata) {//For Logged User
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
					   		<span><input type="submit" name="update" value="Order"></span>
						</div>
						<?php }else{ //For Unkown User?>
						<div>
					    	<span><label>Name</label></span>
					    	<span><input type="text" name="name" placeholder="Enter Your Name...."></span>
					    </div>
					    <div>
					    	<span><label>E-Mail</label></span>
					    	<span><input type="text" name="email" placeholder="Enter Your email...."></span>
					    </div>
					    <div>
					     	<span><label>Mobile No</label></span>
					    	<span><input type="text" name="phone" placeholder="Enter Your phone...."></span>
					    </div>
					    <div>
					    	<span><label>Address</label></span>
					    	<span><input type="text" name="address" placeholder="Enter Your address...."></span>
					    </div>
					    <div>
					    	<span><label>City</label></span>
					    	<span><input type="text" name="city" placeholder="Enter Your city...."></span>
					    </div>
					    <div>
					     	<span><label>Country</label></span>
					    	<span><input type="text" name="country" placeholder="Enter Your country...."></span>
					    </div>
					    <div>
					    	<span><label>Zip Code</label></span>
					    	<span><input type="text" name="zip" placeholder="Enter Your zip...."></span>
					    </div>
					    	<span><label>Password</label></span>
					    	<span><input type="text" name="pass" placeholder="Enter Your Password...."></span>
					    </div>
					    <div>
					   		<span><input type="submit" name="register" value="submit"></span>
						</div>
						<?php } ?>
				    </form>
				</div>
			</div>
		</div> 
    </div>
 </div>
<?php include 'inc/footer.php'; ?>