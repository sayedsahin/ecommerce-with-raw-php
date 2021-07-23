<?php include 'inc/header.php'; ?>
<?php 
	$login = Session::get("customerLogin");
	if ($login == true) {
		header("Location:order.php");
	}
?>
<?php $ctr = new Customer(); ?>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $customerLog = $ctr->customerLogin($_POST);
    }
?>
<div class="main">
    <div class="content">
    	<div class="login_panel">
        	<h3>Existing Customers</h3>
        	<?php 
    			if (isset($customerLog)) {
    				echo $customerLog;
    			}
    		?>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post" id="member">
	        	<input name="email" type="text" placeholder="E-mail" class="field">
	            <input name="pass" type="password" placeholder="Password" class="field">

	            <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
	            <div class="buttons">
	            	<button name="login" class="grey">Sign In</button>
	            </div>
        	</form>
        </div>
        <?php 
		    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
		        $customerReg = $ctr->customerRegister($_POST);
		    }
		?>
    	<div class="register_account">
    		<h3>Register New Account</h3>
    		<?php 
    			if (isset($customerReg)) {
    				echo $customerReg;
    			}
    		?>
    		<form action="" method="post">
			<table>
				<tbody>
				<tr>
					<td>
						<div>
						<input type="text" name="name" placeholder="Name">
						</div>
						<div>
						<input type="text" name="city" placeholder="City">
						</div>
						<div>
						<input type="text" name="zip" placeholder="Zip-Code">
						</div>
						<div>
						<input type="text" name="email" placeholder="E-Mail">
						</div>
					</td>
					<td>
						<div>
						<input type="text" name="address" placeholder="Address">
						</div>
			    		<div>
						<select id="country" name="country" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="afghanistan">Afghanistan</option>
							<option value="albania">Albania</option>
							<option value="algeria">Algeria</option>
							<option value="argentina">Argentina</option>
							<option value="armenia">Armenia</option>
							<option value="aruba">Aruba</option>
							<option value="australia">Australia</option>
							<option value="austria">Austria</option>
							<option value="azerbaijan">Azerbaijan</option>
							<option value="bahamas">Bahamas</option>
							<option value="bahrain">Bahrain</option>
							<option value="bangladesh">Bangladesh</option>
				        </select>
						</div>
				        <div>
				        <input type="text" name="phone" placeholder="Phone">
				        </div>
						<div>
						<input type="text" name="pass" placeholder="Password">
						</div>
				    </td>
			    </tr> 
		    	</tbody>
			</table> 
			<div class="search"><div>
				<button class="grey" name="register">Create Account</button>
			</div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
    	<div class="clear"></div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>