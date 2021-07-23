<?php include 'inc/header.php'; ?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        $upQuantity = $ct->updateQuantity($cartId, $quantity);
    }
?>
<?php 
	$fm = new Format();
 ?>
<?php 
	if (isset($_GET['confirmid']) && isset($_GET['custid']) && isset($_GET['time'])) {
		$id = $_GET['confirmid'];
		$cid = $_GET['custid'];
		$time = $_GET['time'];
		$confirm = $ct->productConfirm($id, $cid, $time);
	}
?>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
		    	<h2>Your Cart</h2>
		    	<?php 
		    		if (isset($confirm)) {
		    			echo $confirm;
		    		}
		    	 ?>
				<table class="tblone">
					<tr>
						<th>No</th>
						<th>Product Name</th>
						<th>Image</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
					<?php 
						$cid = Session::get("customerId");
						$selectCart = $ct->selectOrder($cid);
						if ($selectCart) {
							$i=0;
							while ($result = $selectCart->fetch_assoc()) {
								$i++;
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $fm->textShorten($result['productName'], 20); ?></td>
						<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
						<td><?php echo $result['quantity']; ?></td>
						<td>
						<?php
							$total = $result['price']*$result['quantity'];
							echo "$".$total;
						?>
						</td>
						<td><?php echo $fm->formatDate($result['time']); ?></td>
						<td>
						<?php 
							if ($result['status'] == '0') {
								echo "Pending";
							}elseif($result['status'] == '1'){
								echo "Shifted";
							}else{
								echo "Confirmed";
							}
						 ?>	
						</td>
						<td>
							<?php if ($result['status'] == '0') { ?>
							N/A
							<?php }elseif ($result['status'] == '1') {?>
							<a href="?confirmid=<?php echo $result['orderId']; ?>&custid=<?php echo $result['cId']; ?>&time=<?php echo $result['time']; ?>">Confirm</a>
							<?php }else{ echo "Thanks";} ?>
						</td>
					</tr>
					<?php } }else{ ?>
					<tr><td colspan="8">Data Not Found, Please Shop Product.</td></tr>	
					<?php } ?>						
				</table>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>