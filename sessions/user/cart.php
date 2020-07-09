<?php 
	ob_start();
	session_start();
	require_once(__DIR__ . "/../../services/database_connection.php");
	include "../../services/main.php";
	include "../../services/new_handle_products.php";
	include "../../services/session_cart.php";

	if (! isset($_SESSION["user"])) {
		header("Location: ../../index.php");
	} else {
		$sql = "select * from `user` where `id` = {$_SESSION['user']} and `status` = 'banned'";
		$result = $connection->query($sql);
		$connection->close();
		if ($result->num_rows != 0) {
			header("Location: ../common/logout.php");
		}
	}
	echo "
		<script>
			let myPath = " . json_encode($myPath) . ";
			let products = " . json_encode($_SESSION['products']) . ";
		</script>
	";
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<?php include "../../view/head.php" ?>
</head>
<body class="d-flex flex-column justify-content-between min-vh-100">
	<div>
		<?php include "../../view/navbar.php" ?>
		<main>
			<div class="container">
				<h3 class="pt-5 pb-4 text-center">Cart</h3>
				<!-- cart -->
				<div id="cart"></div>
			</div>
		</main>
	</div>
	<?php include "../../view/footer.php" ?>
	<script src="../../js/main.js"></script>
	<script src="../../js/cart.js"></script>
	<script src="../../ajax/cart.js"></script>
</body>
</html>

<?php ob_end_flush() ?>