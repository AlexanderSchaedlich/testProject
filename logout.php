<?php
    require_once 'actions/db-connect.php';
    session_start();

    if (! isset($_SESSION['user']) && ! isset($_SESSION['admin'])) {
        header("Location: index.php");
    }

    if (isset($_SESSION['user'])) {
        // the session will be saved in the database, so the user may continue with it when logged in again
        $sql = "update `user` set `session` = '" . json_encode($_SESSION) . "' where `id` = {$_SESSION['user']}";
        $conn->query($sql);
        $conn->close();
    }
    // unset session variables
    session_unset();
    // destroy session data
    session_destroy();
    header("Location: index.php");
    // terminate execution of the script
    die;
?>