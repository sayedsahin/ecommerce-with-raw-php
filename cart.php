<?php include 'inc/header.php'; ?>
<?php 
	if (isset($_GET['delcart'])) {
		$id = $_GET['delcart'];
		$delcart = $ct->deleteCart($id);
	}
 ?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $upQuantity = $ct->updateQuantity($cartId, $quantity);
        //Quantity Zero or less than zero cart deleted.
        if ($quantity <= 0) {
        	$delcart = $ct->deleteCart($cartId);
        }
    }
 ?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
		    	<h2>Your Cart</h2>
		    	<?php 
		    		if (isset($upQuantity)) {
		    			echo $upQuantity;
		    		}
		    	?>
		    	<?php 
		    		if (isset($delcart)) {
		    			echo $delcart;
		    		}
		    	?>
				<table class="tblone">
					<tr>
						<th width="10%">No</th>
						<th width="25%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="25%">Quantity</th>
						<th width="25%">Total Price</th>
						<th width="10%">Action</th>
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
						<td><?php echo $result['productName']; ?></td>
						<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
						<td>$<?php echo $result['price']; ?></td>
						<td>
							<form action="" method="post">
								<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
								<input type="number" name="quantity" value="<?php echo $result['quantity']; ?>"/>
								<input type="submit" name="submit" value="Update"/>
							</form>
						</td>
						<td>
						<?php
							$total = $result['price']*$result['quantity'];
							echo "$".$total;
						?>
						</td>
						<td><a href="?delcart=<?php echo $result['cartId']; ?>">X</a></td>
					</tr>
					<?php $sum = $sum + $total; ?>
					<?php } }else{ ?>
					<tr><td colspan="7">Data Not Found, Please Shop Product.</td></tr>	
					<?php } ?>						
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
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>