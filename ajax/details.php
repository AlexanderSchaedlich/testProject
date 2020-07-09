<?php 
	session_start();
	include "../services/session_cart.php";
	if ($_POST) {
		$product = json_decode($_POST["product"], true);
		$product["amount_requested"]++;
		array_push($_SESSION["products"], $product);
		echo ++$_SESSION["total_items"];
	}
?>