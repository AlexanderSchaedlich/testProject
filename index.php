<?php
	ob_start();
	session_start();
	// var_dump($_SESSION["user"]);
	// var_dump($_SESSION["admin"]);

	require "services/database_connection.php";
	include "services/main.php";
	include "services/new_handle_products.php";
	$connection->close();
	for ($i = 0; $i < count($products); $i++) {
		$products[$i]["old_price"] = createCurrencyFormat($products[$i]["old_price"]);
		$products[$i]["new_price"] = createCurrencyFormat($products[$i]["new_price"]);
	}
	usort($products, function($a, $b) {
	    return $b["adding_date"] <=> $a["adding_date"];
	});
	$newProducts = array_slice($products, 0, 5);
	$productsWithDiscount = [];
	foreach ($products as $product) {
		if ($product["discount"] != 0) {
			array_push($productsWithDiscount, $product);
		}
	}
	usort($productsWithDiscount, function($a, $b) {
	    return $b["discount"] <=> $a["discount"];
	});
	echo "
		<script>
			let newProducts = " . json_encode($newProducts) . ";
			let productsWithDiscount = " . json_encode($productsWithDiscount) . ";
			let myPath = " . json_encode($myPath) . ";
		</script>
	";
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<!-- head tags -->
	<?php include "view/head.php" ?>
</head>
<body>
	<!-- navbar -->
	<?php include "view/navbar.php" ?>

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
	<main class="py-5 bg-light">
		<div class="container text-center">
			<h3 class="mt-5 mb-4 mt-md-4 mb-md-3 myH3">New Articles</h3>
			<div id="newProducts" class="cards row mx-0"></div>
			<h3 class="mt-5 mb-4 mt-md-4 mb-md-3 myH3">Articles with Discount</h3>
			<div id="productsWithDiscount" class="cards row mx-0"></div>
			<h3 class="my-5 mt-md-4 mb-md-3 myH3">We Offer</h3>
			<ul class="text-left">
				<li><h5 class="myH5">Modern technologies</h5></li>
				<li><h5 class="myH5">Technical support</h5></li>
				<li><h5 class="myH5">2 years warranty</h5></li>
			</ul>
		</div>
	</main>
	
	<!-- footer -->
	<?php include "view/footer.php" ?>

	<!-- scripts -->
	<script src="js/main.js"></script>
	<script>
		writeCards("newProducts", newProducts);
		writeCards("productsWithDiscount", productsWithDiscount);
	</script>
</body>
</html>

<?php ob_end_flush() ?>