<?php 
    ob_start();
    session_start();
    include "../../../services/database_connection.php";
    include "../../../services/main.php";
    if (isset($_SESSION["products"])) {
        $sql = "select `name`, `email` from `user` where `id` = {$_SESSION['user']}" ;
        $result = $connection->query($sql);
        $connection->close();
        $user = $result->fetch_assoc();
        $recipient = $user["email"];
        $topic = "Order confirmation";
        $sender = "From: Team Coffee <nikolaienkoyana@gmail.com>";
        $message = "Hello {$user["name"]},\r\n\r\n
        your order has been received. Order details:\r\n\r\n";
        $sum = 0;
        foreach($_SESSION["products"] as $product) {
            $total = $product["new_price"] * $product["amount_requested"];
            $sum += $total;
            $message .= "Product: {$product['name']}\r\n
            Price per unit: 
            " . createCurrencyFormat($product['new_price']) . "\r\n
            Amount: {$product['amount_requested']}, 
            Total price: 
            " . createCurrencyFormat($total) . "\r\n\r\n";
        }
        $message .= "Sum: 
        " . createCurrencyFormat($sum) . "\r\n\r\n
        Have a nice day!\r\n\r\n
        Best regards,\r\n
        Your Coffee Team";
        $headers = "From: nikolaienkoyana@gmail.com\r\n" .
        "Reply-To: nikolaienkoyana@gmail.com\r\n" .
        "X-Mailer: PHP/" . phpversion();
        mail($recipient, $topic, $message, $headers);
    }
    // $_SESSION["products"] = [];
    // $_SESSION["total_items"] = 0;
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
                <h3>Thank you for your purchase. We'll send you an email with the details of your order.</h3>
            </div>
        </main>
    </div>
    <?php include "../../../view/footer.php" ?>
</body>
</html>

<?php ob_end_flush() ?>