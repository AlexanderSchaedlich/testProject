<?php  
	ob_start();
	require_once(__DIR__ . "/../services/session_cart.php");
?>

<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark p-3 py-md-2 py-lg-1">
	<button class="navbar-toggler ml-3 ml-md-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand p-0 text-light" href="<?php echo $myPath ?>index.php">
		<img src="<?php echo $myPath ?>img/logo_white.png" alt="logo">
		<span class="myP p-1">Coffee</span>
	</a>
	<a class="shoppingCart nav-link text-info" href="<?php echo $myPath ?>cart.php">
		<span>
			<i class="fas fa-shopping-cart"></i>
			<p class="totalItems d-inline"><?php echo $_SESSION["total_items"] ?></p>
		</span>
	</a>
	<div id="navbarNav" class="collapse navbar-collapse">
		<div class="navbar-nav ml-auto py-2 py-lg-0">
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>index.php">Home</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/common/products.php">Products</a>
<?php
	if (isset($_SESSION["admin"])) {
?>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/admin/dashboard.php">Dashboard</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/common/logout.php?logout">Log Out</a>
<?php
	} elseif (isset($_SESSION["user"])) { 
?>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/user/faq.php">FAQ</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/user/contact.php">Contact</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/user/userdashboard.php">Account</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/common/logout.php">Log Out</a>
			<a class="shoppingCart nav-link text-info ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/user/cart.php">
				<span>
					<i class="fas fa-shopping-cart"></i>
					<p class="totalItems d-inline"><?php echo $_SESSION["total_items"] ?></p>
				</span>
			</a>
<?php
	} else {
?>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/user/faq.php">FAQ</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/user/contact.php">Contact</a>
			<a class="nav-link text-white ml-3 ml-md-0 py-md-1" href="<?php echo $myPath ?>sessions/common/login.php">Log In</a>
<?php 
	}
?>
		</div>
	</div>
</nav>

<?php ob_end_flush() ?>