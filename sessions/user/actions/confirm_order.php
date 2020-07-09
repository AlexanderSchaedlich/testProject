<?php 
    ob_start();
    session_start();
    include "../../../services/database_connection.php";
?>

<!DOCTYPE html>
<html>
<head>
    <?php include "../../../view/head.php" ?>
</head>
<body class="d-flex flex-column justify-content-between min-vh-100">
    <div>
        <?php include "../../../view/navbar.php" ?>
        <main>
            <div class="container">
                <h3>Here will be the form for the payment. In a fiew steps, you will be guided to the</h3>
                <a href="<?php echo $myPath ?>sessions/user/actions/order_confirmation.php">Order confirmation</a>
            </div>
        </main>
    </div>
    <?php include "../../../view/footer.php" ?>
</body>
</html>

<?php ob_end_flush() ?>