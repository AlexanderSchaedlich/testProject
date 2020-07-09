<?php
	ob_start();
	session_start();
	require_once(__DIR__ . "/../../services/database_connection.php");
	include(__DIR__ . "/../../services/main.php");
	include(__DIR__ . "/../../services/handle_buttons.php");
	include(__DIR__ . "/../../services/new_handle_products.php");
	echo "
		<script>
			let myPath = " . json_encode($myPath) . ";
		</script>
	";

	if ($_GET["category"] && $_GET["id"]) {
		$category = $_GET["category"];
		$id = $_GET["id"];
		for ($i = 0; $i < count($products); $i++) {
			if ($products[$i]["category"] == $category && $products[$i]["id"] == $id) {
				$product = $products[$i];
				echo "
					<script>
						let product = " . json_encode($product) . ";
					</script>
				";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<!-- head tags -->
	<?php include(__DIR__ . "/../../view/head.php") ?>
</head>
<body>
	<!-- navbar -->
	<?php include(__DIR__ . "/../../view/navbar.php") ?>
	<div id="test">
		
	</div>
<?php  
	if (isset($product)) {
?>
	<main>
		<div class="container mb-5">
			<!-- product -->
			<section>
				<div class="row mx-0">
					<!-- image -->
					<div class="detailsImage col-md-5 col-lg-4 mt-5 mx-auto">
						<img src="<?php echo $product['img']; ?>" alt="smartphone" class="fittingImage">
					</div>
					<!-- technical information -->
					<div class="col-md-7 col-lg-8 mt-5 px-3">
						<h3 class="detailsH3 text-center text-md-left ml-3"><?php echo $product['name']; ?></h3>
						<hr class="my-4 my-md-3">
<?php
	if ($category == "smartphone") {
?>
						<div class="px-3 pb-2">
							<h5 class="detailsH5 mb-3 mb-md-2">Brand</h5>
							<p class="detailsP mb-0"><?php echo $product['brand']; ?></p>
						</div>
						<hr class="mt-3 mb-4 mt-md-2 mb-md-3">
						<div class="px-3">
							<h5 class="detailsH5 mb-3 mb-md-2"><u>Processor</u>:</h5>
							<div class="row">
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">Frequency</h5>
									<p class="detailsP mb-2"><?php echo $product['processor_frequency']; ?></p>
								</div>
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">Type</h5>
									<p class="detailsP mb-2"><?php echo $product['processor_type']; ?></p>
								</div>
							</div>
						</div>
						<hr class="mt-3 mb-4 mt-md-2 mb-md-3">
						<div class="px-3">
							<h5 class="detailsH5 mb-3 mb-md-2"><u>Display</u>:</h5>
							<div class="row">
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">Resolution</h5>
									<p class="detailsP mb-2"><?php echo $product['display_resolution']; ?></p>
								</div>
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">Technology</h5>
									<p class="detailsP mb-2"><?php echo $product['display_technology']; ?></p>
								</div>
							</div>
						</div>
						<hr class="mt-3 mb-4 mt-md-2 mb-md-3">
						<div class="px-3">
							<h5 class="detailsH5 mb-3 mb-md-2"><u>Camera</u>:</h5>
							<div class="row">
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">Main</h5>
									<p class="detailsP mb-2"><?php echo $product['camera_main']; ?></p>
								</div>
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">Front</h5>
									<p class="detailsP mb-2"><?php echo $product['camera_front']; ?></p>
								</div>
							</div>
						</div>
						<hr class="mt-3 mb-4 mt-md-2 mb-md-3">
						<div class="px-3">
							<h5 class="detailsH5 mb-3 mb-md-2"><u>Memory</u>:</h5>
							<div class="row">
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">Ram</h5>
									<p class="detailsP mb-2"><?php echo $product['ram']; ?></p>
								</div>
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">Internal</h5>
									<p class="detailsP mb-2"><?php echo $product['internal_memory']; ?></p>
								</div>
							</div>
						</div>
						<hr class="mt-3 mb-4 mt-md-2 mb-md-3">
						<div class="px-3">
							<h5 class="detailsH5 mb-3 mb-md-2"><u>Network</u>:</h5>
							<div class="row">
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">SIM-Card</h5>
									<p class="detailsP mb-2"><?php echo $product['sim_card']; ?></p>
								</div>
								<div class="col-6">
									<h5 class="detailsH5 mb-3 mb-md-2">SIM-Slot</h5>
									<p class="detailsP mb-2"><?php echo $product['sim_slot']; ?></p>
								</div>
							</div>
						</div>
<?php  
	} else if ($category == "cover") {
?>
						<div class="row px-3">
							<div class="col-6">
								<h5 class="detailsH5 mb-3 mb-md-2">Brand</h5>
								<p class="detailsP mb-2"><?php echo $product['brand']; ?></p>
							</div>
							<div class="col-6">
								<h5 class="detailsH5 mb-3 mb-md-2">Type</h5>
								<p class="detailsP mb-2"><?php echo $product['type']; ?></p>
							</div>
						</div>
<?php  
	} else if ($category == "headphone") {
?>
						<div class="row px-3">
							<div class="col-6">
								<h5 class="detailsH5 mb-3 mb-md-2">Brand</h5>
								<p class="detailsP mb-2"><?php echo $product['brand']; ?></p>
							</div>
							<div class="col-6">
								<h5 class="detailsH5 mb-3 mb-md-2">Type</h5>
								<p class="detailsP mb-2"><?php echo $product['type']; ?></p>
							</div>
						</div>
						<hr class="mt-3 mb-4 mt-md-2 mb-md-3">
						<div class="row px-3">
							<div class="col-6">
								<h5 class="detailsH5 mb-3 mb-md-2">Wireless</h5>
								<p class="detailsP mb-2"><?php echo $product['wireless']; ?></p>
							</div>
							<div class="col-6">
								<h5 class="detailsH5 mb-3 mb-md-2">Electrical Impendance</h5>
								<p class="detailsP mb-2"><?php echo $product['electrical_impendance']; ?></p>
							</div>
						</div>
						<hr class="mt-3 mb-4 mt-md-2 mb-md-3">
						<div class="px-3">
							<h5 class="detailsH5 mb-3 mb-md-2">Microphone</h5>
							<p class="detailsP mb-2"><?php echo $product['microphone']; ?></p>
						</div>
<?php  
	} else if ($category == "charger") {
?>
						<div class="row px-3">
							<div class="col-6">
								<h5 class="detailsH5 mb-3 mb-md-2">Brand</h5>
								<p class="detailsP mb-2"><?php echo $product['brand']; ?></p>
							</div>
							<div class="col-6">
								<h5 class="detailsH5 mb-3 mb-md-2">Output Power</h5>
								<p class="detailsP mb-2"><?php echo $product['output_power']; ?></p>
							</div>
						</div>
<?php  
	}
?>
						<hr class="mt-3 mb-4 mt-md-2 mb-md-3">
						<div class="px-3 flex-wrap d-sm-flex justify-content-between">
							<div class="mb-3">
								<h5 id="newPrice" class="detailsH5 d-inline mr-2 mb-3 mb-md-2"><?php echo createCurrencyFormat($product['new_price']); ?></h5>
								<s><p id="oldPrice" class="detailsP d-inline"><?php echo createCurrencyFormat($product['old_price']); ?></p></s>
							</div>
							<div class="pt-2">
								<button type="button" value="<?php echo $product['id']; ?>" class="detailsP btn btn-info ml-auto  mb-2 myButton" <?php echo $userButton; ?>>Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
			</section>
<?php
	$sql = "select review.id, review.title, review.text_area, review.stars, review.creation_date, user.name, user.email from review
	join user on fk_user = user.id
	where fk_{$category} = {$id}";
	$result = $connection->query($sql);
	$connection->close();
	if ($result->num_rows > 0) {
?>
			<!-- reviews -->
			<section>
				<div class="mb-5">
					<h3 class="detailsH3 mt-5 text-center">Reviews</h3>
					<a href="create_update_review.php?id=<?php echo $product['id']; ?>" class="btn btn-dark" <?php echo $userButton; ?>>Write a Review</a>
<?php
	$reviews = $result->fetch_all(MYSQLI_ASSOC);
	foreach ($reviews as $review) { 
?>
					<div class="review mt-3 p-4 rounded bg-light">
						<div class="row">
							<!-- avatar -->
							<div class="col-md-2 p-md-3 text-center">
								<img src="<?php echo getGravatar($review['email']); ?>" class="detailsAvatar">
								<p class="detailsP mt-2"><?php echo $review['name'] . ' on ' . date('F jS Y', $review['creation_date'] = time()); ?></p>
							</div>
							<!-- text -->
							<div class="col-md-10 px-5 py-md-3 d-flex flex-column">
								<div>
									<span class="d-block d-md-inline mr-3 mb-3 mb.md-0 text-center text-md-left rating"><?php echo createStars($review['stars']); ?></span>
									<h5 class="detailsH5 d-inline"><?php echo $review['title']; ?></h5>
								</div>
								<p class="detailsP mt-2"><?php echo $review['text_area']; ?></p>
								<a href="actions/a_deletereview.php?id=<?php echo $review['id_review']; ?>" class="btn btn-danger align-self-end mt-auto" <?php echo $adminButton; ?>>Delete the Review</a>
							</div>
						</div>
					</div>
<?php   
	}
?>
				</div>
			</section>
<?php   
	}
?>
		</div>
	</main>
<?php  
	}
?>
	<!-- footer -->
	<?php include(__DIR__ . "/../../view/footer.php") ?>

	<!-- hidden form -->
	<!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<input type="hidden" name="cart" value="1">
	</form> -->

	<!-- scripts -->
	<script src="../../js/details.js"></script>
	<script src="../../ajax/details.js"></script>
</body>
</html>

<?php ob_end_flush() ?>