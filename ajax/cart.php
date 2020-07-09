<?php 
	session_start();
	include "../services/session_cart.php";
	if ($_POST) {
		$message = "";
		if ($_POST["action"] == "clear") {
			$_SESSION["products"] = [];
			$_SESSION["total_items"] = 0;
		} else if ($_POST["action"] == "delete") {
			for ($i = 0; $i < count($_SESSION["products"]); $i++) {
				if 
				($_SESSION["products"][$i]["category"] 
				== $_POST["category"] 
				&& $_SESSION["products"][$i]["id"] 
				== $_POST["id"]) 
				{
					$_SESSION["total_items"] 
					-= $_SESSION["products"][$i]["amount_requested"];
					unset($_SESSION["products"][$i]);
					break;
				}
			}
			array_values($_SESSION["products"]); // reindexes the array numerically
		} else if ($_POST["action"] == "decrease") {
			for ($i = 0; $i < count($_SESSION["products"]); $i++) {
				if 
				($_SESSION["products"][$i]["category"] 
				== $_POST["category"] 
				&& $_SESSION["products"][$i]["id"] 
				== $_POST["id"]) 
				{
					$_SESSION["products"][$i]["amount_requested"]--;
					if
					($_SESSION["products"][$i]["amount_requested"] == 0) 
					{
						unset($_SESSION["products"][$i]);
					}
					break;
				}
			}
			array_values($_SESSION["products"]);
			$_SESSION["total_items"]--;
		} else if ($_POST["action"] == "increase") {
			for ($i = 0; $i < count($_SESSION["products"]); $i++) {
				if 
				($_SESSION["products"][$i]["category"] 
				== $_POST["category"] 
				&& $_SESSION["products"][$i]["id"] 
				== $_POST["id"]) 
				{
					if 
					($_SESSION["products"][$i]["amount_available"] 
					>= $_SESSION["products"][$i]["amount_requested"] + 1) 
					{
						$_SESSION["products"][$i]["amount_requested"]++;
						$_SESSION["total_items"]++;
					} else {
						$message = "There ";
						if 
						($_SESSION["products"][$i]["amount_available"] == 1) 
						{
							$message .= "is ";
						} else {
							$message .= "are ";
						}
						$message .= "only " 
						. $_SESSION["products"][$i]["amount_available"] 
						. "items of " 
						. $_SESSION["products"][$i]["name"] 
						. "available.";
					}
					break;
				}
			}
		}
		$array = [
			$_SESSION["products"], 
			$_SESSION["total_items"], 
			$message
		];
		echo json_encode($array);
	}
?>