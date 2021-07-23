<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    include '../classes/Category.php';
    $cat = new Category();
 ?>
<?php 
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        header("Location: catlist.php");
    }else{
        $id = $_GET['catid'];
    }
 ?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $catUpdate = $cat->updateCat($catName, $id);
    }
 ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Category</h2>
                <?php 
                    if (isset($catUpdate)) {
                        echo $catUpdate;
                    }
                 ?>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <?php 
                                $getValue = $cat->getValue($id);
                                if ($getValue) {
                                    while ($result = $getValue->fetch_assoc()) {
                             ?>
                            <td>
                                <input type="text" name="catName" value="<?php echo $result['catName']; ?>" class="medium" />
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