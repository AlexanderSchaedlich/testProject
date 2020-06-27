<?php 
session_start();
require_once 'actions/db-connect.php';
 
// mail($recipient, $topic, $message, $from);

//durch array loopen. Message String formen. an email von $_SESSION['user'] schicken. an name von user bzw. customer addressieren.


if ($_POST){
    echo "thanks for your purchase, we'll send you an email with the details of your order";

    if (isset($_SESSION['cart'])) {
        $sql = "SELECT name, email FROM user WHERE id={$_SESSION['user']}" ;
        $result = $conn->query($sql);
        $data = $result->fetch_assoc();

        $from = "From: Team Coffee <teamcoffee@example.com>";
        $to = $data['email'];

        $confirmMSG = "Hello {$data['name']} your order details,\r\n";
        foreach($_SESSION['cart'] as $cartrow) {
            $msgrow = "{$cartrow['name']} x {$cartrow['quantity']} per unit: {$cartrow['price']}\r\nTotal: {$cartrow['total']}\r\n";
            $confirmMSG .= $msgrow;
        }
        $confirmMSG .= "\r\n\r\nHave a nice day!";
        mail($to, "purchase confirmed (not really)", $confirmMSG, $from);

    }

    unset($_SESSION['cart']);
    
} else {
    header('Location: index.php');
}

?>
