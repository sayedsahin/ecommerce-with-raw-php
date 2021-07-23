<?php include 'inc/header.php'; ?>
<?php 
	$pd = new Product();
	$fm = new Format();
?>
<?php 
	if (isset($_GET['removewlist'])) {
		$wid = $_GET['removewlist'];
		$removewlist = $pd->deleteWishlist($wid);
	}
 ?>
<style>
.rwlist a{color: #d03d1c;font-size: 20px; font-weight: bold;}
</style>
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Wish List</h3>
    		<?php 
    			if (isset($removewlist)) {
    				echo $removewlist;
    			}
    		 ?>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
			<?php 
				$id = Session::get("customerId");
      			$selectwlist = $pd->selectWishlist($id);
      			if ($selectwlist) {
      				while ($result = $selectwlist->fetch_assoc()) {
      		 ?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="details.php?proid=<?php echo $result['productId']; ?>"><img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
				<h2><?php echo $result['productName']; ?></h2>
				<p><?php echo $fm->textShorten($result['body'], 50); ?></p>
				<p><span class="price">$<?php echo $result['price']; ?></span></p>
			    <div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
			    <span class="rwlist"><a href="?removewlist=<?php echo $result['wId']; ?>" class="details">x</a></span>
			</div>
			<?php } }else{ echo "Wishlist Empty! Please Product Added Wishlist"; } ?>
		</div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>