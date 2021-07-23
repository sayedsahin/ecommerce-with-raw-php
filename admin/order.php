<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    include '../classes/Cart.php';
    $fm = new Format();
    $ct = new Cart();
?>
<?php 
	if (isset($_GET['shiftid']) && isset($_GET['custid']) && isset($_GET['time'])) {
		$id = $_GET['shiftid'];
		$cid = $_GET['custid'];
		$time = $_GET['time'];
		$shift = $ct->productShift($id, $cid, $time);
	}
?>
<?php 
	if (isset($_GET['confirmid']) && isset($_GET['custid']) && isset($_GET['time'])) {
		$id = $_GET['confirmid'];
		$cid = $_GET['custid'];
		$time = $_GET['time'];
		$confirm = $ct->productConfirm($id, $cid, $time);
	}
?>
<?php 
	if (isset($_GET['orderdelid']) && isset($_GET['custid']) && isset($_GET['time'])) {
		$id = $_GET['orderdelid'];
		$cid = $_GET['custid'];
		$time = $_GET['time'];
		$remove = $ct->orderDelete($id, $cid, $time);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Order Details</h2>
                <?php 
                	if (isset($shift)) {
                		echo $shift;
                	}elseif (isset($confirm)) {
                		echo $confirm;
                	}elseif (isset($remove)) {
                		echo $remove;
                	}
                 ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>PID</th>
							<th>Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$selectOrder = $ct->getOrderbyAdmin();
							if ($selectOrder) {
								while ($result = $selectOrder->fetch_assoc()) {
						?>
						<tr class="odd gradeX">
							<td><a href="productview.php?viewid=<?php echo $result['productId']; ?>"><?php echo $result['productId']; ?></a></td>
							<td><?php echo $fm->formatDate($result['time'], 20); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td>
							<?php 
								$amount = $result['price'] * $result['quantity'];
								echo $amount; 
							?>
							</td>
							<td><a href="customer.php?custId=<?php echo $result['cId']; ?>"><?php echo $result['cId']; ?> (view)</a></td>
							<td>
								<?php if ($result['status'] == '0') { ?>
								<a href="?shiftid=<?php echo $result['orderId']; ?>&custid=<?php echo $result['cId']; ?>&time=<?php echo $result['time']; ?>">Shifted</a>
								<?php }elseif($result['status'] == '1'){ ?>
								<a href="?confirmid=<?php echo $result['orderId']; ?>&custid=<?php echo $result['cId']; ?>&time=<?php echo $result['time']; ?>">Confirm</a>
								<?php }else{ ?>
								<a href="?orderdelid=<?php echo $result['orderId']; ?>&custid=<?php echo $result['cId']; ?>&time=<?php echo $result['time']; ?>">Remove</a>
								<?php } ?>
								
							</td>
							<?php } } ?>
						</tr>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>