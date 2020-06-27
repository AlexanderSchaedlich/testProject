<?php
	require_once 'actions/db-connect.php';

    $sql = "select * from product where amount_available > 0 and visible = 1";
	$result = $conn->query($sql);
    if ($result->num_rows > 0) {
    	$products = $result->fetch_all(MYSQLI_ASSOC);
    	for ($i = 0; $i < count($products); $i++) {
    		// create old_price, new_price and amount_requested keys and values
    		if ($products[$i]['discount'] != 0) {
    			$products[$i]['old_price'] = $products[$i]['price'];
    			$products[$i]['new_price'] = round($products[$i]['price'] * (100 - $products[$i]['discount'])) / 100;
    		} else {
    			$products[$i]['old_price'] = '';
    			$products[$i]['new_price'] = $products[$i]['price'];
    		}
    		$products[$i]['amount_requested'] = 0;
    	}
    	// complete price format
    	function completeStr($array) {
			for ($i = 0; $i < count($array); $i++) {
				if ($array[$i]['old_price'] != '') {
					$array[$i]['old_price'] = number_format((float)$array[$i]['old_price'], 2, ',', '') . '€';
				}
				$array[$i]['new_price'] = number_format((float)$array[$i]['new_price'], 2, ',', '') . '€';
	    	}
	    	return $array;
	    }
    	$visible = completeStr($products);
    	$forJS = json_encode($visible);
    	echo '<script>let products = ' .$forJS. ';</script>';
		// sort by newPrice (ascending)
	    usort($products, function($a, $b) {
		    return $a['new_price'] <=> $b['new_price'];
		}); 
		$byPriceAsc = completeStr($products);
    	// sort by newPrice (descending)
	    usort($products, function($a, $b) {
		    return $b['new_price'] <=> $a['new_price'];
		});
		$byPriceDesc = completeStr($products);
    	// sort by date (descending)
	    usort($products, function($a, $b) {
		    return $b['adding_date'] <=> $a['adding_date'];
		}); 
		$byDate = completeStr($products);
		$new = array_slice($byDate, 0, 5);
		$d = [];
		foreach ($products as $product) {
			if ($product['discount'] != 0) {
				array_push($d, $product);
			}
		}
		$discount = completeStr($d);
    }
?>