<?php 
	$pd = new Product();
?>
	<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<?php 
						$letestIphon = $pd->selectLetestPro(4/*brand id number*/);
						if ($letestIphon) {
							while ($result = $letestIphon->fetch_assoc()) {
					 ?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
					<?php } } ?>
			   </div>
			   <div class="listview_1_of_2 images_1_of_2">
					<?php 
						$letestSamsung = $pd->selectLetestPro(3);
						if ($letestSamsung) {
							while ($result = $letestSamsung->fetch_assoc()) {
					 ?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Samsung</h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
					<?php } } ?>
			   </div>
			</div>
			<div class="section group">
			   <div class="listview_1_of_2 images_1_of_2">
					<?php 
						$letestAcer = $pd->selectLetestPro(2);
						if ($letestAcer) {
							while ($result = $letestAcer->fetch_assoc()) {
					 ?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
					<?php } } ?>
			   </div>
			   <div class="listview_1_of_2 images_1_of_2">
					<?php 
						$letestCanon = $pd->selectLetestPro(1);
						if ($letestCanon) {
							while ($result = $letestCanon->fetch_assoc()) {
					 ?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $result['productId']; ?>"> <img src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Canon</h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
					<?php } } ?>
			   </div>	
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>