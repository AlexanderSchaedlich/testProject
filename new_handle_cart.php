<?php  
	require_once 'actions/db-connect.php';
	session_start();

	if ($_POST) {
		if ($_POST['do'] == "plus") {
			$sql = "insert into cart (fk_product, fk_user) values ({$_POST['product']}, {$_SESSION['user']})";
		} elseif ($_POST['do'] == "minus") {
			$sql = "delete from cart where fk_user = {$_SESSION['user']} and fk_product = {$_POST['product']} limit 1";
		} elseif ($_POST['do'] == "delete") {
			$sql = "delete from cart where fk_user = {$_SESSION['user']} and fk_product = {$_POST['product']}";
		} elseif ($_POST['do'] == "clear" || $_POST['do'] == "buy") {
			$sql = "delete from cart where fk_user = {$_SESSION['user']}";
		}
		$run = $conn->query($sql);
		$conn->close();
	}
?>