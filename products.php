<?php
	ob_start();
	session_start();
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Smartphones</title>
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/4d20ff7212.js" crossorigin="anonymous"></script>
    <!-- jquery -->
	<script
	src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd" crossorigin="anonymous"></script>
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<!-- navbar -->
	<?php include 'parts/navbar.php'; ?>

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
				<div data-toggle="collapse" data-target="#accessoireCheckboxes" class="sectionHeading d-flex justify-content-between mt-2 mb-4 mt-md-0 mb-md-3">
			    	<div>Accessoire</div>
			    	<div>
			    		<span class="plus ml-1">+</span>
			    		<span class="minus ml-1">-</span>
			    	</div>
			    </div>
			    <div id="accessoireCheckboxes" class="collapse mt-4 mb-5 mt-md-3 mb-md-4">
			    	<div class="wrapper">Smartphone
			    		<input type="checkbox" name="category" value="smartphone">
						<span class="checkmark"></span>
			    	</div>
			    	<div class="wrapper">Cover
			    		<input type="checkbox" name="category" value="cover">
						<span class="checkmark"></span>
			    	</div>
					<div class="wrapper">Headphone
			    		<input type="checkbox" name="category" value="headphone">
						<span class="checkmark"></span>
			    	</div>
					<div class="wrapper">Charger
			    		<input type="checkbox" name="category" value="charger">
						<span class="checkmark"></span>
			    	</div>
			    </div>
			</div>
		    <hr class="my-3">
		    <div class="barSection px-3 px-md-2">
				<div data-toggle="collapse" data-target="#brandCheckboxes" class="sectionHeading d-flex justify-content-between mt-2 mb-4 mt-md-0 mb-md-3">
			    	<div>Brand</div>
			    	<div>
			    		<span class="plus ml-1">+</span>
			    		<span class="minus ml-1">-</span>
			    	</div>
			    </div>
			    <div id="brandCheckboxes" class="collapse mt-4 mb-5 mt-md-3 mb-md-4">
			    	<div class="wrapper">Apple
			    		<input type="checkbox" name="brand" value="Apple">
						<span class="checkmark"></span>
			    	</div>
			    	<div class="wrapper">Samsung
			    		<input type="checkbox" name="brand" value="Samsung">
						<span class="checkmark"></span>
			    	</div>
					<div class="wrapper">HTC
			    		<input type="checkbox" name="brand" value="HTC">
						<span class="checkmark"></span>
			    	</div>
			    </div>
			</div>
		    <hr>
		    <div class="px-3 py-4">
		    	<button type="button" class="btn btn-info w-100 rounded-lg">Close</button>
		    </div>
		</div>

		<!-- content -->
		<main>
			<!-- cards -->
			<div id="cards" class="row h-100 mx-0 bg-light"></div>
		</main>
	</div>

	<!-- footer -->
	<?php include 'parts/footer.php'; ?>

	<!-- scripts -->
	<?php 
		require_once 'actions/db-connect.php';
		include 'new_handle_products.php'; 
		$conn->close();
		echo "
			<script>
				let products = " . json_encode($products) . ";
			</script>
		"; // This converts the php array to a json object. I need the js variable, because I want to use it for client-side functionality - to filter and sort the products. Php variables will be loaded on page load only as they are part of the server-side code. So for seeing the effect of changing them the page would have to be reloaded, and this is what I want to avoid.
	?>
	<script src="js/main.js"></script>
	<script src="js/products.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>