<?php
	ob_start();
	session_start();
	require_once(__DIR__ . "/../../services/database_connection.php");
?>

<!DOCTYPE html>
<html lang="de">
<head>
	<!-- head tags -->
	<?php include "../../view/head.php" ?>
</head>
<body class="d-flex flex-column justify-content-between min-vh-100">
	<div>
		<!-- navbar -->
		<?php include(__DIR__ . "/../../view/navbar.php") ?>
		
		<!-- content -->
		<main>
			<div class="container">
				<h3 class="text-center pt-5 pb-4">Frequently Asked Questions</h3>
				<hr>
<?php 
	$sql = "select * from faq";
	$result = $connection->query($sql);
	$connection->close();
	while ($faq = $result->fetch_assoc()) {
?>
				<h5 class="d-inline"><?php echo $faq['topic']; ?> </h5>
			    <i data-toggle="collapse" data-target="#text<?php echo $faq['id']; ?>" class="fas fa-chevron-down" style="cursor: pointer;"></i>
			    <div id="text<?php echo $faq['id']; ?>" class="collapse">
			    	<br>
			    	<p><?php echo $faq['text']; ?></p>
			    </div>
			    <hr>
<?php
	}
?>
			</div>
		</main>
	</div>
	<div>
		<!-- footer -->
		<?php include(__DIR__ . "/../../view/footer.php") ?>

		<script>
			$(document).ready(function() {
				$(".fa-chevron-down").click(function() {
					$(this).toggleClass("open");
				})
			});
		</script>
	</div>
</body>
</html>

<?php ob_end_flush() ?>