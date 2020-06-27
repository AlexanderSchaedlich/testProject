<?php 
	session_start();
	require "session_cart.php";
	if ($_POST) {
		for ($i = 0; $i < count($products); $i++) {
			if ($products[$i]["id"] == $_POST["id"] && $products[$i]["category"] == $_POST["category"]) {
				array_push($_SESSION["cart"]["products"], $products[$i]);
			}
		}
		// echo ++$_SESSION["cart"]["total_items"];
		// echo "response";
		$_SESSION["test"] = "something";
	}
?>