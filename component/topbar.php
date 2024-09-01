<?php
	session_start();
	if(!isset($_SESSION['customerid']) || empty($_SESSION['customerid'])){
		$cid = '';
	}else{
		$cid = $_SESSION['customerid'];
	}

	include 'dbcon.php';

	$user_email = '';
	if(!empty($cid)) {
		$query = "SELECT user_email FROM user WHERE user_id = '$cid'";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) == 1) {
			$row = mysqli_fetch_assoc($result);
			$user_email = $row['user_email'];
		}
	}
?>

<button onclick="topFunction()" id="scrollBtn" title="Go to top">
	<i class="fa-solid fa-angles-up"></i>
</button>

<nav class="navbar" id="topbar">

	<div class="burger-menu" id="menuM">
		<i class="fa-solid fa-bars"></i>
	</div>

	<div class="logo">
		<a href="index.php">
		<img src="images/logo.png"/>
	</div>
	<div class="navmenu">
		<a href="index.php">Home</a>
		<a href="products.php">All Products</a>
		<a href="contact.php">Contact</a>

		<?php if(!empty($cid)){ ?>
		<a href="history.php">
			Order History
		</a>
		<a href="logout.php">
			Logout
		</a>
		<?php }?>

	</div>
	<div class="rightmenu">

		<?php if(empty($cid)){ ?>
		<a href="login.php">
			<i class="fa-solid fa-circle-user"></i>
			<span>Login</span>
		</a>
		<?php }else{ ?>
		<a href="account.php">
			<i class="fa-solid fa-circle-user"></i>
			<span><?php echo $user_email != '' ? $user_email : 'Account'; ?></span>
		</a>
		<?php } ?>
		<a href="#" class="hide">
			<i class="fa-solid fa-heart"></i>
			<span>Wishlist</span>
		</a>
		<a href="cart.php" class="cart-ico">
			<div class="cartamount">
				<!-- <span>0</span> -->
			</div>
			<img src="images/cart.png"/>
		</a>
		<a href="qr.php" class="qr-ico">
			<div class="#">
				<!-- <span>0</span> -->
			</div>
			<img src="images/qr.png"/>
		</a>
	</div>

</nav>


<div class="mobile-menu" id="m-menu">

	<div class="mobilelink">
		<div class="box">
			<a href="index.php">Home</a>
		</div>
		<div class="box">
			<a href="products.php">All Products</a>
		</div>

		<div class="box">
			<a href="contact.php">Contact</a>
		</div>

		<?php if(!empty($cid)){ ?>
		<div class="box">
			<a href="history.php">
				Order History
			</a>
		</div>
		<div class="box">
			<a href="logout.php">
				 Logout
			</a>
		</div>
		<?php }?>
	</div>	
</div>