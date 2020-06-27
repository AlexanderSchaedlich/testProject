<?php 
	ob_start();
	session_start();
	require_once 'actions/db-connect.php';
	// include 'handle_cart.php';

	if (! isset($_SESSION['user'])) {
		header('Location: index.php');
	} else {
		$sql = "select * from `user` where `id` = {$_SESSION['user']} and `status` = 'banned'";
		$result = $conn->query($sql);
		if ($result->num_rows != 0) {
			header('Location: logout.php?logout');
		}
	}
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Smartphones</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<script
	src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
	integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
	crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4d20ff7212.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.myButton').click(function() {
            	let id = this.value;
            	let action = this.name;
			    $.ajax({
			        url: 'new_handle_cart.php',
			        type: 'POST',
			        data: {
			            product: id,
			            do: action
			        },
			        success: function(r){
			        	console.log(r);
			        },
					error: function(){
						alert("error");
					}          
			    });
			    location.reload();
			    // setTimeout(location.reload.bind(location), 5);
			});
        });
    </script>
</head>
<body class="d-flex flex-column justify-content-between min-vh-100">
	<div>
		<!-- navbar -->
		<?php include 'parts/navbar.php'; ?>
	
		<!-- content -->
		<main>
			<div class="container">
				<h3 class="pt-5 pb-4 text-center">Cart</h3>
<?php 
	$sql = "select * from cart where fk_user = {$_SESSION['user']}";
	$result = $conn->query($sql);
	$conn->close();
	if ($result->num_rows != 0) {
?>
				<table class="w-100">
					<tbody>
						<tr>
							<th><p>Product</p></th>
							<th><p>Quantity</p></th>
							<th><p>Price</p></th>
							<th class="text-right"><p>Total</p></th>
							<th></th>
						</tr>
<?php  
	$sum = 0;
	while ($product = $result->fetch_assoc()) {
		$price = round($product['price'] * (100 - $product['discount'])) / 100;
		$total = $price * $product['amount_requested'];
		$totalString = number_format((float)$total, 2, ',', '') . '€';
		$sum += $total;
?>
						<tr>
							<td><?php echo $product['name']; ?></td>
							<td><?php echo $product['amount_requested']; ?></td>
							<td><?php echo $product['new_price']; ?></td>
							<td class="text-right"><?php echo $totalString; ?></td>
							<td class="text-right">
								<!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="d-inline">
									<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
									<input type="hidden" name="do" value="increase">
									<button type="submit">+</button>
								</form>
								<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="d-inline">
									<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
									<input type="hidden" name="do" value="decrease">
									<button type="submit">-</button>
								</form>
								<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="d-inline">
									<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
									<input type="hidden" name="do" value="delete">
									<button type="submit">
										<i class="fas fa-trash-alt"></i>
									</button>
								</form> -->
								<button type="submit" class="myButton" name="plus" value="<?php echo $product['id']; ?>">+</button>
								<button type="submit" class="myButton" name="minus" value="<?php echo $product['id']; ?>">-</button>
								<button type="submit" class="myButton" name="delete" value="<?php echo $product['id']; ?>">
									<i class="fas fa-trash-alt"></i>
								</button>
							</td>
						</tr>
<?php  
	}
	$sumString = number_format((float)$sum, 2, ',', '') . '€';
?>
					</tbody>
				</table>
				<br>
				<h5 class="mb-3 text-success">Sum: <?php echo $sumString; ?></h5>
				<form action="confirmorder.php" method="post" class="d-inline mr-2">
					<input type="submit" name="buy" value="Buy" class="btn btn-success">
				</form>
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="d-inline">
					<input type="hidden" name="do" value="clear">
					<!-- <button type="submit" name="clear" class="btn btn-warning">Clear All</button> -->
				</form>
				<button type="submit" class="myButton btn btn-warning" name="clear">Clear All</button>
<?php 
	} else {
?>
				<h3 class="text-info">Your cart is empty.</h3>
<?php
	}
?>
			</div>
		</main>
	</div>
	<div>
		<!-- footer -->
		<?php include 'parts/footer.php'; ?>
	</div>
<?php  
	if (isset($notification)) {
		echo '<script>alert("' . $notification . '");</script>';
	}
?>
</body>
</html>

<?php ob_end_flush(); ?>