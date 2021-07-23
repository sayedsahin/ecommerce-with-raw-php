<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    include '../classes/Category.php';
    include '../classes/Brand.php';
    include '../classes/Product.php';
    $pd = new Product();
 ?>
<?php 
    if (!isset($_GET['viewid']) || $_GET['viewid'] == NULL) {
        header("Location: productlist.php");
    }else{
        $id = $_GET['viewid'];
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product Edit</h2>
        <div class="block">             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <?php 
                    $selectPro = $pd->selectProduct($id);
                    if ($selectPro) {
                        while ($value = $selectPro->fetch_assoc()) {
                 ?>             
                <tr>
                    <td><label>Name</label></td>
                    <td><?php echo $value['productName']; ?></p></td>
                </tr>
				<tr>
                    <td><label>Category</label></td>
                    <td><?php echo $value['catName']; ?></td>
                </tr>
				<tr>
                    <td><label>Brand</label></td>
                    <td><?php echo $value['brandName']; ?></td>
                </tr>
				
				 <tr>
                    <td><label>Description</label></td>
                    <td><?php echo $value['body']; ?></td>
                </tr>
				<tr>
                    <td><label>Price</label></td>
                    <td><?php echo $value['price']; ?></td>
                </tr>
            
                <tr>
                    <td style="vertical-align: middle;"><label>Image</label></td>
                    <td><img src="<?php echo $value['image']; ?>" height="150px" width="200px" alt=""></td>
                </tr>
				
				<tr>
                    <td><label>Type</label></td>
                    <td>
                    	<?php if ($value['type'] == 1) { echo 'Feature'; } ?>
                    	<?php if ($value['type'] == 2) { echo 'General'; } ?>
                    </td>
                </tr>

				<tr>
                    <td></td>
            		<td><button><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Back</a></button></td><br>
                </tr>
            </table>
            <?php } } ?>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


