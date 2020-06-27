<?php  
	ob_start();
	require_once "parts/session_cart.php";
?>

<nav id="navbar" class="navbar navbar-expand-lg navbar-dark bg-dark p-3 py-md-2 py-lg-1">
	<button class="navbar-toggler ml-3 ml-md-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand p-0 text-light" href="index.php">
		<img src="img/logo_white.png" alt="logo">
		<span class="p-1">Coffee</span>
	</a>
	<a class="shoppingCart nav-link text-info" href="cart.php">
		<span>
			<i class="fas fa-shopping-cart"></i>
			<p class="d-inline">00</p>
		</span>
	</a>
	<div id="navbarNav" class="collapse navbar-collapse">
		<div class="navbar-nav ml-auto py-2 py-lg-0">
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="index.php">Home</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="products.php">Products</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="faq.php">FAQ</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="contact.php">Contact</a>
<?php
	if (isset($_SESSION['admin'])) {
?>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="dashboard.php">Dashboard</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="logout.php?logout">Log Out</a>
<?php
	} elseif (isset($_SESSION['user'])) { 
?>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="userdashboard.php">Account</a>
			<a class="nav-link text-light ml-3 ml-md-0 py-md-1" href="logout.php">Log Out</a>
			<a class="shoppingCart nav-link text-info ml-3 ml-md-0 py-md-1" href="cart.php">
				<span>
					<i class="fas fa-shopping-cart"></i>
					<p id="totalItems" class="d-inline"><?php echo $_SESSION["cart"]["total_items"]; ?></p>
				</span>
			</a>
<?php
	} else {
?>
			<a class="nav-link text-white ml-3 ml-md-0 py-md-1" href="login.php">Log In</a>
<?php 
	}
?>
		</div>
	</div>
</nav>

<?php ob_end_flush(); ?>