<?php
    session_start();
    require_once(__DIR__ . "/../../services/database_connection.php");

    if 
    (! isset($_SESSION["user"]) 
    && ! isset($_SESSION["admin"]))
    {
        header("Location: ../../index.php");
    }

    if (isset($_SESSION["user"])) {
        // the cart will be saved in the database, so the user may continue shopping when logged in again
        $cart = [$_SESSION["products"], $_SESSION["total_items"]];
        $sql = "update `user` set `cart` = '" . json_encode($cart) . "' where `id` = {$_SESSION['user']}";
        $connection->query($sql);
        $connection->close();
    }
    // unset session variables
    session_unset();
    // destroy session data
    session_destroy();
    header("Location: ../../index.php");
    // terminate the execution of the script
    die;
?>