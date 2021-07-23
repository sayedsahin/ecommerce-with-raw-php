<?php include 'inc/header.php'; ?>
<?php 
	$pd = new Product();
 ?>
<style>
.tblone td{border: 1px solid #ccc; text-align: left;}
.tblone th{ text-align: left; width: 15%; border-bottom: 1px solid #7b7b7b; vertical-align: middle;}
.tblone td img {height: 200px;width: 150px;}
.pcompare input[type="number"]{margin: 5px 0 5px 0;}
input[type="text"] {border: 1px solid #b8b8b8; border-radius: 3px; padding: 7px; margin: 5px 0 5px 0;}
select{padding: 6px 0px; border: 1px solid #CCC; border-radius: 5px; margin: 6px 0;}

</style>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
				<h2>Compare</h2>
				<?php 
					if (isset($_GET['pro1']) && !isset($_GET['pro2'])) {
						$id = $_GET['pro1'];
				 ?>
				 <form action="" method="get" class="pcompare">
				 	<p>Product One</p>
				 	<?php 
				 		$comvalue = $pd->selectCompare($id)->fetch_assoc();
				 		if ($comvalue) {
				 	 ?>
					<input type="hidden" class="buyfield" name="pro1" value="<?php echo $comvalue['productId']; ?>"/>
					<input type="text" readonly class="buyfield" name="" value="<?php echo $comvalue['productName']; ?>"/>
					<?php } ?>
					<p>Product Tow</p>
					
					<select name="pro2">
						<option>Select Compare Product</option> 
						<?php 
							$protow = $pd->SelectCompareTow();
							if ($protow) {
								while ($result = $protow->fetch_assoc()) {
						 ?>        
						<option value="<?php echo $result['productId']; ?>"><?php echo $result['productName']; ?></option>
						<?php } } ?>
			        </select>
					<br><input type="submit" class="buysubmit" name="" value="Compare"/>
				</form>
				<?php } ?>
				<?php 
					if (isset($_GET['pro1']) && isset($_GET['pro2'])) {
				        $idone = $_GET['pro1'];
				        $idtow = $_GET['pro2'];
				 ?>
				<table class="tblone lfloat">
					<?php 
						$comone = $pd->selectCompare($idone)->fetch_assoc();
						$comtow = $pd->selectCompare($idtow)->fetch_assoc();
						if ($comone && $comtow) {
					?>
					<tr>
						<th>Product Name</th>
						<td><?php echo $comone['productName']; ?></td>
						<td><?php echo $comtow['productName']; ?></td>
					</tr>
					<tr>
						<th>Image</th>
						<td><img src="admin/<?php echo $comone['image']; ?>" alt=""/></td>
						<td><img src="admin/<?php echo $comtow['image']; ?>" alt=""/></td>
					</tr>
					<tr>
						<th>Product Id</th>
						<td><?php echo $comone['productId']; ?></td>
						<td><?php echo $comtow['productId']; ?></td>
					</tr>
					
					<tr>
						<th>Price</th>
						<td>$<?php echo $comone['price']; ?></td>
						<td>$<?php echo $comtow['price']; ?></td>
					</tr>
					<tr>
						<th>Description</th>
						<td><?php echo $comone['body']; ?></td>
						<td><?php echo $comtow['body']; ?></td>
					</tr>
					<?php } ?>
				</table>
				<?php } //$_get if?>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>