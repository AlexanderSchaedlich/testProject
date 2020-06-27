<?php
	ob_start();
	session_start();
	include 'handle_products.php';
	include 'handle_buttons.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Smartphones</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script
	src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4d20ff7212.js" crossorigin="anonymous"></script>
</head>
<body>
	<!-- navbar -->
	<?php include 'parts/navbar.php'; ?>

	<!-- slider -->
	<div id="homeHero" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="carousel-item active heroItem">
				<img src="https://cdn.pixabay.com/photo/2015/03/26/09/44/cell-phone-690192__480.jpg" class="fittingImage d-block" alt="smartphone">
			</div>
			<div class="carousel-item heroItem">
				<img src="https://cdn.pixabay.com/photo/2015/06/08/15/09/photography-801891__480.jpg" class="fittingImage d-block" alt="smartphone">
			</div>
			<div class="carousel-item heroItem">
				<img src="https://cdn.pixabay.com/photo/2015/01/08/18/24/smartphone-593318__480.jpg" class="fittingImage d-block" alt="smartphone">
			</div>
		</div>
		<a class="carousel-control-prev" href="#homeSlider" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#homeSlider" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>

	<!-- content -->
	<main>
		<div class="container text-center">
			<h3 class="mt-5 mb-2">New Articles</h3>
			<div class="row" style="padding: 30px 30px 0 30px;">
<?php 
	foreach ($new as $product) {
?>
				<div class="col-md-3" style="padding-bottom: 30px;">
					<div class="p-2 rounded-lg border shadow">
						<a href="details.php?id=<?php echo $product['id']; ?>" class="text-body" style="text-decoration: none;">
							<div class="fitImgDiv mb-3">
								<img src="<?php echo $product['img']; ?>" alt="smartphone" class="fitImg rounded-sm">
							</div>
							<p class="mb-1"><?php echo $product['name']; ?></p>
							<p><?php echo $product['new_price']; ?></p>
						</a>
						<!-- <form action="handle_cart.php" method="post">
							<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
							<input type="hidden" name="do" value="increase">
							<button type="submit" value="<?php echo $product['id']; ?>" class="myButton btn btn-info" <?php echo $userButton; ?>>Add to Cart</button>
						</form> -->
						<!-- <a href="#" value="<?php echo $dataArray; ?>" class="addButton btn btn-info" <?php echo $userButton; ?>>Add to Cart</a> -->
						<button value='<?php echo $product['id']; ?>' class='increase btn btn-info' <?php echo $userButton; ?>>Add to Cart</button>
					</div>
				</div>
<?php  
	}
?>
			</div>
			<h3 class="mt-4 mb-2">Articles with Discount</h3>
			<div class="row" style="padding: 30px 30px 0 30px;">
<?php 
	foreach ($discount as $product) {
?>
				<div class="col-md-3" style="padding-bottom: 30px;">
					<div class="p-2 rounded-lg border shadow">
						<a href="details.php?id=<?php echo $product['id']; ?>" class="text-body" style="text-decoration: none;">
							<div class="fitImgDiv mb-3">
								<img src="<?php echo $product['img']; ?>" alt="smartphone" class="fitImg rounded-sm">
							</div>
							<p class="mb-1"><?php echo $product['name']; ?></p>
							<p><?php echo $product['new_price']; ?></p>
						</a>
						<!-- <form action="handle_cart.php" method="post">
							<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
							<input type="hidden" name="do" value="increase">
							<button type="submit" class="btn btn-info" <?php echo $userButton; ?>>Add to Cart</button>
						</form> -->
						<button value='<?php echo $product['id']; ?>' class='increase btn btn-info' <?php echo $userButton; ?>>Add to Cart</button>
					</div>
				</div>
<?php 
	}
?>
			</div>
			<h3 class="my-4">We Offer</h3>
			<ul class="text-left">
				<li><h5>Modern technologies</h5></li>
				<li><h5>Technical support</h5></li>
				<li><h5>2 years warranty</h5></li>
			</ul>
		</div>
	</main>
	
	<!-- footer -->
	<?php include 'parts/footer.php'; ?>
</body>
</html>

<?php ob_end_flush(); ?>