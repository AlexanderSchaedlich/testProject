<?php
	// get reviews
	$sql = "select * from review";
	$result = $conn->query($sql);
	$reviews = $result->fetch_all(MYSQLI_ASSOC);
	$products = [];
	function getProducts($name) {
		$sql = "select * from {$name} where amount_available > 0 and visible = 1";
		global $conn;
		$result = $conn->query($sql);
		while ($product = $result->fetch_assoc()) // fetches result row as associative array while there is a row to fetch
		{
			// create additional attributes for each product:
			// category
			$product['category'] = $name;
			// old price and new price
			if ($product['discount'] != null && $product['discount'] > 0) {
				$product['old_price'] = $product['price'];
				$product['new_price'] = round($product['price'] * (100 - $product['discount'])) / 100;
			} else {
				$product['old_price'] = 0;
				$product['new_price'] = $product['price'];
			}
			// ratings and average of stars (integer)
			$product['ratings'] = 0;
			$sum = 0;
			global $reviews;
			foreach ($reviews as $review) {
				$foreignKey = "fk_{$name}";
				if ($review[$foreignKey] == $product['id']) // if I would select products and their respective reviews using sql join statements I would loose the product id as it would be overwritten by the review id; anyway it's more handy to have products and reviews stored in separate variables
				{
					$product['ratings']++;
					$sum += $review['stars'];
				}
			}
			if ($product['ratings'] != 0) {
				$product['stars'] = round($sum / $product['ratings']);
			} else {
				$product['stars'] = 0;
				$product['ratings'] = "";
			}
			global $products;
			array_push($products, $product);
		}
	}
	getProducts('smartphone');
	getProducts('cover');
	getProducts('headphone');
	getProducts('charger');
?>