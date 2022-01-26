<?php include 'inc/header.php'; ?>
<?php 
	$pd = new Product();
	$cat = new Category();
	//$ct = new Cart(); (This object on header)
 ?>
<?php 
    if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
        header("Location: 404.php");
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
    }
?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $addCart = $ct->insertCart($quantity, $id);
    }
?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
        $customerId = $_POST['customerId'];
        $addWlist = $pd->insertWishlist($customerId, $id);
    }
?>
<style>
/*ol, ul {list-style: unset; margin: unset; padding: 16px;}*/
.showmsg{color: red; font-size: 18px;}
.compare a { color: #fff; background: #ff5722; padding: 5px 15px; display: inline-block; margin: 10px 3px 0px 0px; border-radius: 2px; float: left;}
.compare input[type="submit"] { color: #fff; background: #ff5722; padding: 5px 15px; display: inline-block; margin: 10px 3px 0px 0px; border-radius: 2px;font-size: 16px; border: 0; cursor:pointer;}
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
			<div class="cont-desc span_1_of_2">
				<?php 
					$selectPd = $pd->selectProduct($id);
					if ($selectPd) {
						while ($result = $selectPd->fetch_assoc()) {
				?>
				<div class="grid images_3_of_2">
					<img src="admin/<?php echo $result['image']; ?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>
					<p>You can return this product for a full refund within 3 calendar days of receiving your order.</p>

					<p>Please read the Return and Replacement Policy Page thoroughly before requesting a return or replacement for your purchased item.</p>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
					<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>
					<span class="showmsg">
					<?php 
						if (isset($addCart)) {
							echo $addCart;
						} 
						if (isset($addWlist)) {
							echo $addWlist;
						}
					?>
					</span>
					<div class="compare">
						<a href="compare.php?pro1=<?php echo $result['productId']; ?>">Compare</a>
						<form action="" method="post">
							<input type="hidden" name="customerId" value="<?php echo Session::get("customerId"); ?>"/>
							<input type="submit" name="wishlist" value="Save to list"/>
						</form>
					</div>			
					</div>
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<?php echo $result['body']; ?>
		    	</div>
		    	<?php } }else{ header('Location: 404.php'); } ?>	
			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php 
						$selectCat = $cat->getCatlist();
						if ($selectCat) {
							while ($result = $selectCat->fetch_assoc()) {
					 ?>
					<li><a href="productbycat.php?catid=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
				<?php } } ?>
				</ul>
			</div>
 		</div>
 	</div>
</div>
<?php include 'inc/footer.php'; ?>