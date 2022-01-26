<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	include '../classes/Product.php';
	include_once '../helpers/Format.php';
	$pd = new Product();
	$fm = new Format();
 ?>
<?php 
	if (isset($_GET['delproduct'])) {
		$id = $_GET['delproduct'];
		$delPro = $pd->deleteProduct($id);
	}
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block"> 
		<?php 
			if (isset($delPro)) {
				echo $delPro;
			}
		 ?>
        <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No</th>
					<th>Post Title</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$getProduct = $pd->getAllProduct();
					if ($getProduct) {
						$i = 0;
						while ($result = $getProduct->fetch_assoc()) {
							$i++;
				 ?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $fm->textShorten($result["productName"], 30); ?></td>
					<td><?php echo $result["catName"]; ?></td>
					<td><?php echo $result["brandName"]; ?></td>
					<td><?php echo strip_tags($fm->textShorten($result["body"], 50)); ?></td>
					<td>$<?php echo $result["price"]; ?></td>
					<td style="vertical-align: middle;">
						<img src="<?php echo $result["image"]; ?>" height="40px" width="40px" alt="">
					</td>
					<td class="center">
						<?php 
							if ($result["type"] == 1) {
								echo "Feature";
							}elseif ($result["type"] == 2) {
								echo "General";
							}
						 ?>	
					</td>
					<td><a href="productview.php?viewid=<?php echo $result['productId']; ?>">View</a> | <a href="productedit.php?pid=<?php echo $result['productId']; ?>">Edit</a> | <a onclick="return confirm('Are You Sure To Delete !')" href="?delproduct=<?php echo $result['productId']; ?>">Delete</a>
					</td>
				</tr>
				<?php } } ?>
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
