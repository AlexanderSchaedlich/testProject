<?php 
	if(! isset($_SESSION["cart"])) {
		$_SESSION["cart"] = array("products" => [], "total_items" => 0);
	}
?>