<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    include '../classes/Category.php';
    include '../classes/Brand.php';
    include '../classes/Product.php';
    $pd = new Product();
 ?>
<?php 
    if (!isset($_GET['pid']) || $_GET['pid'] == NULL) {
        header("Location: productlist.php");
    }else{
        $id = $_GET['pid'];
    }
 ?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $proUpdate = $pd->updateProduct($_POST, $_FILES, $id);
    }
 ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Product Edit</h2>
        <div class="block"> 
        <?php 
            if (isset($proUpdate)) {
                echo $proUpdate;
            }
         ?>              
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <?php 
                    $selectPro = $pd->slelectProById($id);
                    if ($selectPro) {
                        while ($value = $selectPro->fetch_assoc()) {
                 ?>             
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $value['productName']; ?>" class="medium" name="productName" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                            <?php 
                                $cat = new Category();
                                $geCategory = $cat->getCatlist();
                                if ($geCategory) {
                                    while ($result = $geCategory->fetch_assoc()) {
                             ?>
                            <option 
                            <?php 
                                if ($value['catId'] == $result['catId']) {
                                    echo 'selected="selected"';
                                }
                             ?>
                             value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php 
                                $brand = new Brand();
                                $getBrand = $brand->getBrandlist();
                                if ($getBrand) {
                                    while ($result = $getBrand->fetch_assoc()) {
                             ?>
                            <option 
                            <?php 
                                if ($value['brandId'] == $result['brandId']) {
                                    echo 'selected="selected"';
                                }
                             ?>
                             value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
                            <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name="body"><?php echo $value['body']; ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $value['image']; ?>" height="150px" width="200px" alt=""><br>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option <?php if ($value['type'] == 1) { echo 'selected="selected"'; } ?> value="1">Featured</option>
                            <option <?php if ($value['type'] == 2) { echo 'selected="selected"'; } ?> value="2">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
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


