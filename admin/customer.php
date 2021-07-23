<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    include '../classes/Customer.php';
    $ctr = new Customer();
 ?>
<?php 
    if (!isset($_GET['custId']) || $_GET['custId'] == NULL) {
        header("Location: catlist.php");
    }else{
        $id = $_GET['custId'];
    }
?>
<style>
.font{font-size:15px;color: #757575;padding-bottom: 5px;font-weight: bold;}
</style>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Your Profile</h2>
                <div class="block copyblock">
                    <?php
                        $cusdata = $ctr->getCustomerData($id);
                        if ($cusdata) {
                            $result = $cusdata->fetch_assoc();
                    ?>
                    <div>
                        <span class="font"><label>Name:</label></span>
                        <span><?php echo $result['name']; ?></span>
                    </div>
                    <div>
                        <span class="font"><label>E-Mail:</label></span>
                        <span><?php echo $result['email']; ?></span>
                    </div>
                    <div>
                        <span class="font"><label>Mobile No:</label></span>
                        <span><?php echo $result['phone']; ?></span>
                    </div>
                    <div>
                        <span class="font"><label>Address:</label></span>
                        <span><?php echo $result['address']; ?></span>
                    </div>
                    <div>
                        <span class="font"><label>City:</label></span>
                        <span><?php echo $result['city']; ?></span>
                    </div>
                    <div>
                        <span class="font"><label>Country:</label></span>
                        <span><?php echo $result['country']; ?></span>
                    </div>
                    <div>
                        <span class="font"><label>Zip:</label></span>
                        <span><?php echo $result['zip']; ?></span>
                    </div>
                    <button><a href="order.php">Back</a></button>
                    <?php }else{ header("Location:order.php"); } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>