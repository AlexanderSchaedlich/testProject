<?php
	ob_start();
	session_start();
	require_once(__DIR__ . "/../../services/database_connection.php");
	include(__DIR__ . "/../../services/new_handle_products.php");
	$connection->close();
	echo "
		<script>
			let products = " . json_encode($products) . ";
			let myPath = " . json_encode($myPath) . ";
		</script>
	";
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<!-- head tags -->
	<?php include "../../view/head.php" ?>
</head>
<body>
	<!-- navbar -->
	<?php include(__DIR__ . "/../../view/navbar.php") ?>

	<!-- hero -->
	<div id="productHero">
		<img src="https://cdn.pixabay.com/photo/2016/05/27/08/51/mobile-phone-1419275__480.jpg" alt="smartphone" class="fittingImage">
	</div>

	<!-- horizontal filter and sort bar -->
	<div id="horizontalBar" class="bg-white border-top border-bottom">
		<div>
			<div id="filterBar" class="pr-md-3">
				<span>Filter</span>
				<span>|</span>
				<span id="filteredItems"></span>
				<span>&#10005;</span>
				<hr>
			</div>
			<div id="criteriaBar"></div>
			<div id="criteriaButton">
				<span class="more border rounded-lg px-1">More +</span>
				<span class="less border rounded-lg px-1">Less -</span>
			</div>
			<div id="sortBar" class="pl-md-3">
				<label for="sort" class="mb-0">Sort</label>
				<select id="sort">
					<option value="new_price ascending" selected>Price Ascending</option>
					<option value="new_price descending">Price Descending</option>
					<option value="adding_date descending">Date</option>
					<option value="stars descending">Rating</option>
				</select>
			</div>
		</div>
	</div>

	<!-- page wrapper -->
	<div class="d-flex">
		<!-- vertical filter bar -->
		<div id="verticalBar" class="h-100 p-3 px-md-2 py-md-3">
			<div class="barSection px-3 px-md-2">
				<div data-toggle="collapse" data-target="#accessoireCheckboxes" class="sectionHeading d-flex justify-content-between mt-2 mb-4 mt-md-0 mb-md-3 myH5">
			    	<div>Accessoire</div>
			    	<div>
			    		<span class="plus ml-1">+</span>
			    		<span class="minus ml-1">-</span>
			    	</div>
			    </div>
			    <div id="accessoireCheckboxes" class="collapse mt-4 mb-5 mt-md-3 mb-md-4">
			    	<div class="wrapper myP">Smartphone
			    		<input type="checkbox" name="category" value="smartphone">
						<span class="checkmark"></span>
			    	</div>
			    	<div class="wrapper myP">Cover
			    		<input type="checkbox" name="category" value="cover">
						<span class="checkmark"></span>
			    	</div>
					<div class="wrapper myP">Headphone
			    		<input type="checkbox" name="category" value="headphone">
						<span class="checkmark"></span>
			    	</div>
					<div class="wrapper myP">Charger
			    		<input type="checkbox" name="category" value="charger">
						<span class="checkmark"></span>
			    	</div>
			    </div>
			</div>
		    <hr class="my-3">
		    <div class="barSection px-3 px-md-2">
				<div data-toggle="collapse" data-target="#brandCheckboxes" class="sectionHeading d-flex justify-content-between mt-2 mb-4 mt-md-0 mb-md-3 myH5">
			    	<div>Brand</div>
			    	<div>
			    		<span class="plus ml-1">+</span>
			    		<span class="minus ml-1">-</span>
			    	</div>
			    </div>
			    <div id="brandCheckboxes" class="collapse mt-4 mb-5 mt-md-3 mb-md-4">
			    	<div class="wrapper myP">Apple
			    		<input type="checkbox" name="brand" value="Apple">
						<span class="checkmark"></span>
			    	</div>
			    	<div class="wrapper myP">Samsung
			    		<input type="checkbox" name="brand" value="Samsung">
						<span class="checkmark"></span>
			    	</div>
					<div class="wrapper myP">HTC
			    		<input type="checkbox" name="brand" value="HTC">
						<span class="checkmark"></span>
			    	</div>
			    </div>
			</div>
		    <hr>
		    <div class="px-3 py-4">
		    	<button type="button" class="btn btn-info w-100 rounded-lg myP">Close</button>
		    </div>
		</div>

		<!-- content -->
		<main class="pb-5">
			<!-- cards -->
			<div id="cards" class="cards row h-100 mx-0 bg-light"></div>
		</main>
	</div>

	<!-- footer -->
	<?php include(__DIR__ . "/../../view/footer.php") ?>

	<!-- scripts -->
	<script src="../../js/main.js"></script>
	<script src="../../js/products.js"></script>
</body>
</html>

<?php ob_end_flush() ?>