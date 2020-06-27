<?php
	ob_start();
	session_start();
	require_once 'actions/db-connect.php';
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
    <style>
		.fa-chevron-down {
			transform: rotate(0deg);
			transition: all 0.5s;
		}
		.fa-chevron-down.open {
			transform: rotate(180deg);
			transition: all 0.5s;
		}
    </style>
</head>
<body class="d-flex flex-column justify-content-between min-vh-100">
	<div>
		<!-- navbar -->
		<?php include 'parts/navbar.php'; ?>
		
		<!-- content -->
		<main>
			<div class="container">
				<h3 class="text-center pt-5 pb-4">Frequently Asked Questions</h3>
				<hr>
<?php 
	$sql = "select * from faq";
	$result = $conn->query($sql);
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
		<?php include './parts/footer.php'; ?>

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

<?php ob_end_flush(); ?>