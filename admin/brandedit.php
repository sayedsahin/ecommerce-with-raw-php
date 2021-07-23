<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    include '../classes/Brand.php';
    $brand = new Brand();
 ?>
<?php 
    if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
        header("Lobrandion: brandlist.php");
    }else{
        $id = $_GET['brandid'];
    }
 ?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $brandUpdate = $brand->updateBrand($brandName, $id);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
                <?php 
                    if (isset($brandUpdate)) {
                        echo $brandUpdate;
                    }
                 ?>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <?php 
                                $getValue = $brand->getValue($id);
                                if ($getValue) {
                                    while ($result = $getValue->fetch_assoc()) {
                             ?>
                            <td>
                                <input type="text" name="brandName" value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                            <?php } }else{ header('Location: 404.php'); } ?>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>